<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class production_group_barang extends Model
{
    use HasFactory;
    protected $table = 'production_group_barang';
    protected $fillable =[
        'production_group_id',
        'barang_id',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }


}
