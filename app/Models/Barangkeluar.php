<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang-keluar';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'penanggung_jawab',
        'barang_keluar',
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
}
