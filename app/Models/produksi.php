<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produksi extends Model
{
    use HasFactory;
    protected $table = 'produksis';
    protected $fillable =[
        'name',
        'start',
        'finish',
        'results',
        'information',
        'unit',
    ];
}
