<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $table = 'hasils';
    protected $fillable = [
        'sesi',
        'tanggal_ujian',
        'file_path',
        'keterangan',
        
    ];
    
}
