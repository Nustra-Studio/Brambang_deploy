<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;
    protected $table = 'histories';
    protected $fillable =[
        'name',
        'price',
        'basic_price',
        'status',
        'qty',
        'information',
        'unit',
        'more'
    ];
}
