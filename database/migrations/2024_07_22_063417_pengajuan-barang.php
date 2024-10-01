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
        Schema::create('pengajuan-barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengadaan');
            $table->string('nama_projek');
            $table->integer('jumlah_barang');
            $table->string('keterangan');
            $table->date('tanggal_dibuat');
            $table->string('penanggung_jawab');
            $table->string('status');
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
