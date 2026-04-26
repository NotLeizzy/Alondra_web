<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Employees;

class StockIn extends Model
{
    protected $table = 'stock_in';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'employee_id',
        'quantity',
        'selling_price'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
}