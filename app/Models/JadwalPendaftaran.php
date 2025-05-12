<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pendaftaran';  // Nama tabel di database
    protected $fillable = [
        'judul',
        'content',
        'kuota',
    ];
}
