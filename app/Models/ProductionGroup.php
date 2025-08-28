<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionGroup extends Model
{
    use HasFactory;
    protected $table = 'production_groups';
    protected $fillable =[
        'name',
        'item',
        'optional',
    ];
}
