<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalPendaftaran extends Model
{
    protected $table = 'jadwal_pendaftaran';

    protected $fillable = [
        'lokasi',
        'tgl_buka',
        'tgl_tutup',
        'kuota',


        'tgl_buka',
        'tgl_tutup',
    ];

    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class, 'jadwal_id');
    }

    public function getTanggalMulaiFormattedAttribute()
    {
        return Carbon::parse($this->tgl_buka)->format('d F Y');
    }

    public function getTanggalAkhirFormattedAttribute()
    {
        return Carbon::parse($this->tgl_tutup)->format('d F Y');
    }

}
