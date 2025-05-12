<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ujian';  // Nama tabel di database
    protected $fillable = [
        'tanggal',
        'jam',
        'kampus_cabang',
        'jurusan',
        'program_studi',
    ];
}
