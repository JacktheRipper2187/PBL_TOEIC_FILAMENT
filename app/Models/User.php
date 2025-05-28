<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Pastikan method ini selalu return string valid
    public function getFilamentName(): string
    {
        return $this->username ?? 'User';
    }

    // Jika Filament mengharapkan properti `name`, buat accessor ini
    public function getNameAttribute(): string
    {
        return $this->username ?? 'User';
    }
}
