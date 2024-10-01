<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang-masuk'; // Ensure this matches the table name

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nama_supplier',
        'jumlah_masuk',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function DataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'nama_barang', 'id');
    }

    public function DataSupplier()
    {
        return $this->belongsTo(DataSupplier::class, 'nama_supplier', 'id');
    }
}
