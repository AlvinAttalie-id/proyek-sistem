<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengadaan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengadaan');
            $table->string('kode_proyek');
            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->date('tanggal_dibuat');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengadaan_barang');
    }
};

