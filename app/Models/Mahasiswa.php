<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nim',
        'no_telp',
        'kampus',
        'jurusan',
        'prodi',
        'pengambilan_sertifikat',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function konfirmasiSk()
    {
        return $this->hasOne(KonfirmasiSk::class);
    }
}
