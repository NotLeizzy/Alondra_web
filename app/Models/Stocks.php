<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'stocks';
    protected $fillable = [
        'stocks_name',
        'cost_price'
    ];

    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }
}