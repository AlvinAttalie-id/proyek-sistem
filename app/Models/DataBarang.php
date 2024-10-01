<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $table = 'data-barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga_barang',
        'jumlah_barang',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kodeBarang()
    {
        return $this->belongsTo(KodeBarang::class, 'kode_barang', 'id');
    }
}
