<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayNameAttribute()
    {
        if ($this->anonim == 1) {
            return 'Anonim';
        }

        if ($this->rahasia == 1) {
            return 'Rahasia';
        }

        return $this->user?->username;
    }
}
