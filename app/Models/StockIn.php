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