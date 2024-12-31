<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'tempat_tinggal',
        'tanggal_lahir',
        'status',
        'pekerjaan',
        'foto_artis',
        'royalty_balance', // Tambahkan saldo royalti untuk keperluan pembayaran
    ];

    // Relasi many-to-many dengan model Concert
    public function concerts()
{
    return $this->belongsToMany(Concert::class, 'artist_concert');
}


    // Relasi dengan lagu
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    // Relasi one-to-many dengan model RoyaltyPayment
    public function royaltyPayments()
    {
        return $this->hasMany(RoyaltyPayment::class);
    }
}
