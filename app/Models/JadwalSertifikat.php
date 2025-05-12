<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSertifikat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sertifikat';  // Nama tabel di database
    protected $fillable = [
        'waktu',
        'lokasi',
        'hari_tanggal',
        'keterangan',
    ];
}
