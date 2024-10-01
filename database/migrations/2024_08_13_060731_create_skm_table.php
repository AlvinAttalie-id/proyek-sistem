<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skm', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('skm', function (Blueprint $table) {
            $table->id();
            $table->decimal('nilai1');
            $table->decimal('nilai2');
            $table->decimal('nilai3');
            $table->decimal('total_nilai'); // Kolom total_nilai
            $table->date('tanggal_awal'); // Kolom tanggal_awal, boleh null
            $table->date('tanggal_akhir'); // Kolom tanggal_akhir, boleh null
            $table->string('keterangan');
            $table->timestamps();
        });
    }
};
