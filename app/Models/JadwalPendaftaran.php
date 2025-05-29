<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalPendaftaran extends Model
{
    protected $table = 'jadwal_pendaftaran';

    // Field yang bisa diisi
    protected $fillable = [
        'skema',
        'tgl_buka',
        'tgl_tutup',
        'kuota',
        'keterangan',
    ];

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
}