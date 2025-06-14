<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class JadwalPendaftaran extends Model
{
    protected $table = 'jadwal_pendaftaran';

    // Field yang bisa diisi
    protected $fillable = [
        'nama_jadwal',
        'skema',
        'tgl_buka',
        'tgl_tutup',
        'kuota',
        'kuota_asli',
        'keterangan',
        'status_manual'
    ];
    protected $casts = [
        'tgl_buka' => 'date',
        'tgl_tutup' => 'date',
    ];
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!is_null($this->status_manual)) {
                    return (bool)$this->status_manual;
                }

                $now = now();
                return $now->between($this->tgl_buka, $this->tgl_tutup);
            }
        );
    }

    public function jadwalPelaksanaans(): HasMany
    {
        return $this->hasMany(JadwalPelaksanaan::class, 'jadwal_pendaftaran_id');
    }
    // Relasi: satu jadwal bisa memiliki banyak pendaftar
    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class, 'jadwal_id');
    }

    // Akses format tanggal buka yang sudah diformat
    public function getTanggalMulaiFormattedAttribute()
    {
        return Carbon::parse($this->tgl_buka)->translatedFormat('d F Y');
    }

    // Akses format tanggal tutup yang sudah diformat
    public function getTanggalAkhirFormattedAttribute()
    {
        return Carbon::parse($this->tgl_tutup)->translatedFormat('d F Y');
    }
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ($model->isDirty('thumbnail') && $model->getOriginal('thumbnail') !== null) {
                Storage::disk('public')->delete($model->getOriginal('thumbnail'));
            }
            Cache::forget('active_gratis_schedules');
        });

        // ⬇ Tambahkan ini
        static::deleting(function ($pendaftar) {
            if ($pendaftar->jadwal) {
                $pendaftar->jadwal->increment('kuota');
            }
        });
    }
    public function getIsPendaftaranDibukaAttribute()
    {
        $today = now()->format('Y-m-d');

        if (!is_null($this->status_manual)) {
            return $this->status_manual; // manual override
        }

        // default logika berdasarkan tanggal
        return $today >= $this->tgl_buka && $today <= $this->tgl_tutup;
    }
    public function getJadwal()
    {
        return $this->find($this->selectedJadwalId);
    }

    public function isActive()
    {
        $now = now();

        // Jika manual, ikuti status_manual
        if (!is_null($this->status_manual)) {
            return (bool)$this->status_manual;
        }

        // Jika otomatis, cek periode dan updated_at
        return $now->between($this->tgl_buka, $this->tgl_tutup);
    }
    // Method untuk mendapatkan status terakhir
    public static function getLastModifiedStatus()
    {
        return self::whereNotNull('status_manual')
            ->latest('updated_at')
            ->first();
    }
    // Di JadwalPendaftaran.php
    public static function getActiveGratisSchedules()
    {
        return self::where('skema', 'gratis')
            ->where(function ($query) {
                $query->where('status_manual', 1)
                    ->orWhere(function ($q) {
                        $now = now();
                        $q->whereNull('status_manual')
                            ->where('tgl_buka', '<=', $now)
                            ->where('tgl_tutup', '>=', $now);
                    });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => Str::lower(trim($item->nama_jadwal)),
                    'original_name' => $item->nama_jadwal, // Pastikan ini ada
                    'status' => $item->isActive(),
                    'manual' => $item->status_manual,
                    'periode' => $item->tgl_buka->format('Y-m-d') . ' sampai ' . $item->tgl_tutup->format('Y-m-d')
                ];
            });
    }
    public static function getMatchingActiveSchedule($title)
    {
        $lowerTitle = Str::lower(trim($title));

        return self::where('skema', 'gratis')
            ->where(function ($query) {
                $query->where('status_manual', 1)
                    ->orWhere(function ($q) {
                        $now = now();
                        $q->whereNull('status_manual')
                            ->where('tgl_buka', '<=', $now)
                            ->where('tgl_tutup', '>=', $now);
                    });
            })
            ->get()
            ->filter(function ($schedule) use ($lowerTitle) {
                $scheduleName = Str::lower(trim($schedule->nama_jadwal));

                // Prioritas 1: Cocok persis
                if ($lowerTitle === $scheduleName) {
                    return true;
                }

                // Prioritas 2: Nama jadwal mengandung judul
                if (Str::contains($scheduleName, $lowerTitle)) {
                    return true;
                }

                // Prioritas 3: Judul mengandung nama jadwal
                if (Str::contains($lowerTitle, $scheduleName)) {
                    return true;
                }

                return false;
            })
            ->sortByDesc(function ($schedule) {
                // Prioritaskan yang manual terlebih dahulu
                return !is_null($schedule->status_manual);
            })
            ->first();
    }

    // Tambahkan di JadwalPendaftaran.php
    public static function getActiveScheduleForStaticTitle()
    {
        $now = now();

        return self::where('skema', 'gratis')
            ->where(function ($query) use ($now) {
                $query->where('status_manual', 1)
                    ->orWhere(function ($q) use ($now) {
                        $q->whereNull('status_manual')
                            ->where('tgl_buka', '<=', $now)
                            ->where('tgl_tutup', '>=', $now);
                    });
            })
            // Utamakan yang sedang dalam periode aktif
            ->orderByRaw("CASE WHEN tgl_buka <= ? AND tgl_tutup >= ? THEN 0 ELSE 1 END", [$now, $now])
            // Kemudian urutkan berdasarkan status manual (1 pertama)
            ->orderByRaw('CASE WHEN status_manual IS NULL THEN 0 ELSE 1 END DESC')
            // Terakhir urutkan berdasarkan updated_at terbaru
            ->orderByDesc('updated_at')
            ->first();
    }

    public static function refreshAutoStatus()
    {
        $now = now();
        $autoSchedules = self::where('skema', 'gratis')
            ->whereNull('status_manual')
            ->get();

        foreach ($autoSchedules as $schedule) {
            // Update timestamp hanya jika periode sedang berlangsung
            if ($now->between($schedule->tgl_buka, $schedule->tgl_tutup)) {
                $schedule->touch();
            }
        }
    }
}
