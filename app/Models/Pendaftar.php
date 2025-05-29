<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log; // tambahkan ini di bagian atas

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftars';

    protected $fillable = [
        'nama_lengkap',
        'nim_nik',
        'email',
        'alamat_asal',
        'alamat_sekarang',
        'kampus',
        'jurusan',
        'program_studi',
        'foto_formal',
        'upload_ktp',
        'upload_ktm',
        'jadwal_id' // pastikan ini ada
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalPendaftaran::class, 'jadwal_pendaftaran_id');
    }

protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pendaftar) {
            Log::info('🔁 Menghapus pendaftar:', ['id' => $pendaftar->id]);

            $jadwal = $pendaftar->jadwal; // relasi via jadwal_pendaftaran_id

            if ($jadwal) {
                $kuotaSebelum = $jadwal->kuota;
                $jadwal->increment('kuota');
                Log::info('✅ Kuota jadwal berhasil ditambah kembali', [
                    'jadwal_id' => $jadwal->id,
                    'kuota_sebelum' => $kuotaSebelum,
                    'kuota_setelah' => $jadwal->kuota + 1,
                ]);
            } else {
                Log::warning('⚠️ Jadwal tidak ditemukan saat menghapus pendaftar', [
                    'id' => $pendaftar->id,
                    'jadwal_pendaftaran_id' => $pendaftar->jadwal_pendaftaran_id,
                ]);
            }
        });
}
}
