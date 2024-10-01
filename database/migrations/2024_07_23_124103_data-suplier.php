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

    public function up()
    {
        Schema::create('data-supplier', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier');
            $table->string('alamat_supplier');
            $table->string('email_supplier');
            $table->string('nomor_telepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_supplier_barang');
    }
};

