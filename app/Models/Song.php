<?php
// app/Models/Song.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist_id', 'genre_id', 'file_path', 'tempo', 'play_count'];

    // Relasi dengan artis
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // Relasi dengan genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
