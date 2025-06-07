<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiSk extends Model
{
    protected $table = 'konfirmasi_sks';

    protected $fillable = [
        'mahasiswa_id', 'sertifikat_1', 'sertifikat_2',
        'file_sk', 'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}

