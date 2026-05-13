<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'products_name',
        'unit_code',
        'color',
        'cost_price'
    ];

    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }
}
