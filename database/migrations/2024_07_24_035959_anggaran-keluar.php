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
        Schema::create('anggaran-keluar', function (Blueprint $table) {
            $table->id('');
            $table->string('kode_proyek');
            $table->date('tanggal_keluar');
            $table->decimal('jumlah_keluar', 15, 2);
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
