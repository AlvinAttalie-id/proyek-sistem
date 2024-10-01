<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        Schema::create('data-barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->text('nama_barang');
            $table->text('harga_barang');
            $table->string('jumlah_barang');
            $table->date('tanggal');
            $table->text('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
