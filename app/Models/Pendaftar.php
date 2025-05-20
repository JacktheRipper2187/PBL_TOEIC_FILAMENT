<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
