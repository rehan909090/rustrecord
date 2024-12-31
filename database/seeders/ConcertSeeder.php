<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Concert;
use App\Models\Artist;

class ConcertSeeder extends Seeder
{
    public function run()
    {
        $artist1 = Artist::create(['name' => 'Artist 1', 'bio' => 'Bio artist 1']);
        $artist2 = Artist::create(['name' => 'Artist 2', 'bio' => 'Bio artist 2']);

        $concert = Concert::create([
            'title' => 'Concert 1',
            'description' => 'Description for concert 1',
            'location' => 'Venue 1',
            'date' => now(),
            'ticket_price' => 100000,
            'image' => 'concert_image.jpg',
        ]);

        // Menambahkan artis ke konser
        $concert->artists()->attach([$artist1->id, $artist2->id]);
    }
}
