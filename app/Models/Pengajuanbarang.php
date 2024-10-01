<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanbarang extends Model
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

    public function kodeBarang()
    {
        return $this->belongsTo(KodeBarang::class, 'nama_barang', 'id');
    }
}
