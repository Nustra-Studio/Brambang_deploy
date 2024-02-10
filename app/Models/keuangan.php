<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keuangan extends Model
{
    use HasFactory;
    protected $table = 'keuangans';
    protected $fillable =[
        'name',
        'money',
        'status',
        'information',
        'more'
    ];
}
