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
        Schema::create('barang-masuk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->text('nama_barng');
            $table->text('nama_suplier');
            $table->string('jumlah_masuk');
            $table->date('tanggal');
            $table->text('status');
            $table->timestamps();
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
