<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'FormPendaftaran';

    protected $fillable = [
        'nama_lengkap',
        'nim',
        'email',
        'no_hp',
        'alamat_asal',
        'alamat_sekarang',
        'kampus',
        'jurusan',
        'prodi',
        'pas_foto_path',
        'ktp_path',
        'ktm_path',
        'is_verified'
    ];

    // Jika ingin menambahkan akses khusus untuk admin
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    // Format tanggal pendaftaran
    public function getTanggalDaftarAttribute()
    {
        return $this->created_at->format('d F Y');
    }
}