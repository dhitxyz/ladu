<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'classification',
        'judul',
        'isi',
        'tanggal',
        'lokasi',
        'instansi',
        'kategori',
        'lampiran',
        'anonim',
        'rahasia',
        'status'
    ];

    protected $casts = [
    'lampiran' => 'array',
    'anonim' => 'boolean',
    'rahasia' => 'boolean',
    ];
}
