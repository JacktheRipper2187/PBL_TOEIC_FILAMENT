<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaTerdaftar extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa_terdaftar';

    protected $fillable = [
        'nama_lengkap',
        'nim',
        'no_hp',
        'email',
        'alamat_asal',
        'kampus',
        'jurusan',
        'program_studi',
    ];
}
