<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSupplier extends Model
{
    use HasFactory;

    protected $table = 'data-suplier';

    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'email_supplier',
        'nomor_telepon',
        'tanggal_awal',
        'tanggal_akhir',
        'status',

    ];
}
