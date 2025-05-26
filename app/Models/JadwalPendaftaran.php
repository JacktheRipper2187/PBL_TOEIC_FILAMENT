<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPendaftaran extends Model
{
    protected $table = 'jadwal_pendaftaran';

    protected $fillable = [
        'lokasi',
        'tgl_buka',
        'tgl_tutup',
        'kuota',
    ];
}
