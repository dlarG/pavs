<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'email',
        'password',
        'role',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
    ];

    // Add this method to determine redirect after verification
    public function getRedirectRoute()
    {
        return match($this->role) {
            'staff' => 'staff.dashboard',
            'doctor' => 'doctor.dashboard',
            default => 'client.dashboard',
        };
    }
}