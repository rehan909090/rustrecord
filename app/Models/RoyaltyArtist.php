<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoyaltyArtist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'royalty_amount'];

    // Misalnya jika artis memiliki banyak transaksi, kita bisa relasikan ke transaksi mereka.
    public function transactions()
    {
        return $this->hasMany(RoyaltyTransaction::class);
    }
}
