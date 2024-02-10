<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable =[
        'name',
        'price',
        'id_barang',
        'action',
        'id_customer',
        'information',
        'status',
        'qty'
    ];
}
