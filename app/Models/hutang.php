<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hutang extends Model
{
    use HasFactory;
    protected $table = 'utangs';
    protected $fillable =[
        'name',
        'saldo',
        'more',
        'option',
        'information'
    ];
}
