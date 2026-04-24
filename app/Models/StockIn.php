<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Stocks;
use App\Models\Suppliers;
use App\Models\Employees;

class StockIn extends Model
{
    protected $table = 'stock_in';

    protected $fillable = [
        'stock_id',
        'supplier_id',
        'employee_id',
        'quantity',
        'selling_price'
    ];

    public function stock()
    {
        return $this->belongsTo(Stocks::class, 'stock_id');
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