<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable =[
        'name',
        'price',
        'basic_price',
        'status',
        'qty',
        'information',
        'unit'
    ];
    public function productionGroups()
    {
        return $this->belongsToMany(ProductionGroup::class, 'production_group_barang');
    }
}
