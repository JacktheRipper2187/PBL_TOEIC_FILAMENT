<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

$tableName = 'pendaftaran';

class pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
    'title', 'title_id', 'title_en',
    'thumbnail', 'thumbnail_id', 'thumbnail_en',
    'content', 'content_id', 'content_en',
    'link'
];
    protected static function boot()
{
    parent::boot();

    static::updating(function ($model) {
        if ($model->isDirty('thumbnail') && ($model->getOriginal('thumbnail') !== null)) {
            Storage::disk('public')->delete($model->getOriginal('thumbnail'));
        }
    });
}

}
