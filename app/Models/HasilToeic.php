<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilToeic extends Model
{
    protected $table = 'hasil_toeic';

    protected $fillable = [
        'name', 'nim', 'l', 'r', 'tot', 'group', 'position', 'category', 'test_date',
    ];
}
