<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gajis';
    protected $fillable =[
        'name',
        'id_karyawan',
        'total',
        'status',
        'more',
        'information'
    ];
}
