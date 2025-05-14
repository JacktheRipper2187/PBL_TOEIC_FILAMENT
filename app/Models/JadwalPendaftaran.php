<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pendaftaran';

    protected $fillable = [
        'judul',
        'content',
        'kuota',
        'tanggal_mulai',   // Kolom tanggal mulai
        'tanggal_akhir',   // Kolom tanggal akhir
    ];

    // Accessor untuk menampilkan format tanggal yang lebih mudah dibaca
    public function getTanggalMulaiFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_mulai)->format('d F Y');
    }

    public function getTanggalAkhirFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_akhir)->format('d F Y');
    }
}
