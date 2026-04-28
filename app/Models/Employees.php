<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'contact_number',
        'role'
    ];

    // One employee can have many stock-in records
    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    // Accessor for concatenated full name
    public function getFullNameAttribute()
    {
        return trim(
            $this->first_name . ' ' .
            ($this->middle_name ?? '') . ' ' .
            $this->last_name
        );
    }
}