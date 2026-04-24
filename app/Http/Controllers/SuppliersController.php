<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        return Suppliers::all();
    }

    public function store(Request $request)
    {
        return Suppliers::create($request->all());
    }

    public function show(Suppliers $supplier)
    {
        return $supplier;
    }

    public function update(Request $request, Suppliers $supplier)
    {
        $supplier->update($request->all());
        return $supplier;
    }

    public function destroy(Suppliers $supplier)
    {
        $supplier->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
