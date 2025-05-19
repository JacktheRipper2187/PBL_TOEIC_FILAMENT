<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pendaftaran';

    protected $fillable = [
        'lokasi',
        'kuota',
        'tgl_buka',   // Kolom tanggal mulai
        'tgl_tutup',   // Kolom tanggal akhir
    ];

    // Accessor untuk menampilkan format tanggal yang lebih mudah dibaca
    public function getTanggalMulaiFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tgl_buka)->format('d F Y');
    }

    public function getTanggalAkhirFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tgl_tutup)->format('d F Y');
    }
}
