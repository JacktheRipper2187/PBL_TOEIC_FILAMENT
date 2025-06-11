<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_terdaftar_id',
        'sesi_ujian_id',
        'jadwal_ujian_peserta_id',
    ];

    public function mahasiswaTerdaftar(): BelongsTo
    {
        return $this->belongsTo(MahasiswaTerdaftar::class);
    }

    public function sesiUjian(): BelongsTo
    {
        return $this->belongsTo(SesiUjian::class);
    }
}