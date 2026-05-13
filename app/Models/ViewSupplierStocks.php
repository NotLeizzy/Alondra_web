<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewSupplierStocks extends Model
{
    protected $table = 'view_supplier_stocks';

    public $timestamps = false;
    protected $guarded = [];

    // This view doesn't have a specific ID, so it's best to treat it as non-incrementing
    public $incrementing = false;
    protected $primaryKey = null;
}
