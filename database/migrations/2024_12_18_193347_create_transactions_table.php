<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concert_id')->constrained()->onDelete('cascade'); // Asumsi ada relasi dengan tabel concerts
            $table->string('order_id')->unique(); // ID unik untuk order
            $table->integer('amount'); // Jumlah transaksi
            $table->string('status'); // Status transaksi
            $table->string('payment_type'); // Jenis pembayaran (misalnya Midtrans)
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi untuk menghapus tabel.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}