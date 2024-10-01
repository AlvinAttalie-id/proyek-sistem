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
        Schema::create('proyek-bidang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_proyek');
            $table->text('nama_proyek');
            $table->text('bidang');
            $table->date('tanggal');
            $table->string('total_anggaran');
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
