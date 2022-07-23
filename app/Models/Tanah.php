<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik',
        'letak',
        'ukuran',
        'batas',
        'peruntukan',
        'riwayat_tanah',
        'coordinates',
        'registration',
    ];

    protected $casts = [
        'pemilik' => 'json',
        'ukuran' => 'json',
        'batas' => 'json',
        'coordinates' => 'json',
        'registration' => 'json',
    ];
}
