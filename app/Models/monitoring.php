<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoring extends Model
{
    use HasFactory;

    protected $table = 'proyek'; // Ensure this matches the table name

    protected $fillable = [
        'kode_proyek',
        'nama_proyek',
        'penanggung_jawab',
        'bidang',
        'tanggal',
        'keterangan',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
