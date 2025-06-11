<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    ];
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
    }