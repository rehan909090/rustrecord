<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom-kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'birthdate', 'address', 'profile_image'
    ];

    // Kolom-kolom yang disembunyikan (hidden)
    protected $hidden = [
        'password', 'remember_token',
    ];
}
