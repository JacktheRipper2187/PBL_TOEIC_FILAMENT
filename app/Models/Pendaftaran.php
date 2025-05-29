<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'title', 'title_id', 'title_en',
        'thumbnail', 'thumbnail_id', 'thumbnail_en',
        'content', 'content_id', 'content_en',
        'link',
        'nama_lengkap', 'nim_nik', 'email',
        'alamat_asal', 'alamat_sekarang',
        'kampus', 'jurusan', 'program_studi',
        'foto_formal', 'upload_ktp', 'upload_ktm',
        'jadwal_id'
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalPendaftaran::class, 'jadwal_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus file lama jika thumbnail diupdate
        static::updating(function ($model) {
            if ($model->isDirty('thumbnail') && $model->getOriginal('thumbnail')) {
                Storage::disk('public')->delete($model->getOriginal('thumbnail'));
            }
        });

        // Tambah kuota jika data dihapus
        static::deleting(function ($model) {
            if ($model->jadwal) {
                $model->jadwal->increment('kuota');
            }
        });
    }
}
