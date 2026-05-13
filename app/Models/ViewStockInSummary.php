<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewStockInSummary extends Model
{
    protected $table = 'view_stock_in_summary';

    public $timestamps = false;
    protected $guarded = [];

    protected $primaryKey = 'transaction_id';
}
