<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorDataset extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'id',
        'jenis',
        'warna_dominan_1',
        'warna_dominan_2',
        'warna_dominan_3',
        'warna_dominan_4',
        'warna_dominan_5',
        'warna_kombinasi',
        'teori_warna',
    ];
}
