<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    const ROLE_ADMIN = 'admin';
    const ROLE_CHEF = 'chef';
    const ROLE_USER = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'avatar_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function isAdmin()
    {
        if ($this->role !== self::ROLE_ADMIN) {
            return false;
        }

        return true;
    }

    public function isChef()
    {
        if ($this->role !== self::ROLE_CHEF) {
            return false;
        }

        return true;
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatars')->exists($this->avatar)) {
            return url('storage/avatars/'.auth()->user()->avatar);
        } else {
            return asset('avatar.jpg');
        }
    }
}