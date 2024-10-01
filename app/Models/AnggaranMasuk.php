<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranMasuk extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'anggaran-masuk';

    // Define the primary key for the model
    // protected $primaryKey = 'no';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'kode_proyek',
        'tanggal_masuk',
        'jumlah_masuk',
        'keterangan',
        'status',
    ];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'tanggal_masuk' => 'date',
        'jumlah_masuk' => 'decimal:2',
    ];
}
