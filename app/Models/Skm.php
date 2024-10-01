<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skm extends Model
{
    use HasFactory;
    protected $table = 'skm'; // Ensure this matches the table name

    protected $fillable = [
        'nilai1',
        'nilai2',
        'nilai3',
        'total_nilai',
        'tanggal_awal',
        'tanggal_akhir',
        'keterangan',
    ];
    
}
