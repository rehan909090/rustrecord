<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'ticket_price',
        'image',
    ];
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_concert');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
