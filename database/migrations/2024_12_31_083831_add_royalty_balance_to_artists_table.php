<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_royalty_balance_to_artists_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoyaltyBalanceToArtistsTable extends Migration
{
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->decimal('royalty_balance', 10, 2)->default(0)->after('foto_artis');
        });
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('royalty_balance');
        });
    }
}
