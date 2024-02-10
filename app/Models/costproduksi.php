<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costproduksi extends Model
{
    use HasFactory;
    protected $table = 'costproduksis';
    protected $fillable =[
        'name',
        'price',
        'id_produksi',
        'status',
        'qty',
        'information',
        'unit'
    ];
}
