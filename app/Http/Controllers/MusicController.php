<?php
// database/migrations/xxxx_xx_xx_create_songs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul lagu
            $table->string('artist'); // Nama artis
            $table->string('genre'); // Genre musik
            $table->integer('tempo'); // Tempo lagu
            $table->string('file_path'); // Path file musik
            $table->integer('play_count')->default(0); // Statistik play
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
