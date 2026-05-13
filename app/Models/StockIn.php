<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $table = 'stock_in';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'employee_id',
        'quantity',
        'selling_price', // ✅ ADDED SELLING PRICE
    ];

    protected static function booted()
    {
        static::saving(function ($stockIn) {
            if ($stockIn->quantity <= 0) {
                throw new \InvalidArgumentException('Error: Stock-in quantity must be 1 or greater.');
            }
        });
    }

    public function Employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function Product()
    {
        return $this->belongsTo(Products::class);
    }

    public function Supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }
}