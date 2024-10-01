<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranKeluar extends Model
{
    use HasFactory;

    protected $table = 'anggaran-keluar'; // Ensure this matches the table name

    protected $fillable = [
        'kode_proyek',
        'tanggal_keluar',
        'jumlah_keluar',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_keluar' => 'date',
    ];
}
