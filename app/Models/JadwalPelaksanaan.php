<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPelaksanaan extends Model
{
    protected $table = 'jadwal_pelaksanaan';
    protected $fillable = [
        'jadwal_pendaftaran_id',
        'tanggal',
        'sesi',
        'jam_mulai',
        'jam_selesai',
        'lokasi_platform'
    ];

    public function jadwalPendaftaran(): BelongsTo
    {
        return $this->belongsTo(JadwalPendaftaran::class, 'jadwal_pendaftaran_id');
    }

    // Otomatis simpan data repeater ke dalam database
    protected static function booted()
    {
        static::saving(function ($model) {
            // Pastikan hanya dijalankan jika ada sesi_list
            if (request()->has('sesi_list')) {
                $sesiList = collect(request('sesi_list'))
                    ->map(function ($item) use ($model) {
                        return [
                            'jadwal_pendaftaran_id' => $model->jadwal_pendaftaran_id,
                            'tanggal' => $item['tanggal'] ?? $model->tanggal, // Gunakan tanggal dari item jika ada
                            'sesi' => $item['sesi'],
                            'jam_mulai' => $item['jam_mulai'],
                            'jam_selesai' => $item['jam_selesai'],
                            'lokasi_platform' => $item['lokasi_platform'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    })
                    ->toArray();

                // Hapus hanya data yang terkait dengan model ini
                self::where('jadwal_pendaftaran_id', $model->jadwal_pendaftaran_id)
                    ->delete();

                // Simpan data baru
                self::insert($sesiList);
            }
        });
    }
}