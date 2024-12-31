<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_title',
        'artist_name',
        'file_path',
        'status',
        'genre_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
