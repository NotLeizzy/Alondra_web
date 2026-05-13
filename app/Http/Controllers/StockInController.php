<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Suppliers;
use App\Models\Employees;
use App\Models\Products;
use App\Models\ViewStockInSummary;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::all();
        $suppliers = Suppliers::all();
        $employees = Employees::all();

        $query = ViewStockInSummary::query();
 
         // 🔍 SEARCH (product name + processed by)
         if ($request->search) {
             $query->where('products_name', 'like', '%' . $request->search . '%')
                 ->orWhere('processed_by', 'like', '%' . $request->search . '%');
         }
 
         $stockins = $query->get();

        return view('stock-in.index', compact('products', 'suppliers', 'employees', 'stockins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'employee_id' => 'required|exists:employees,id',
            'quantity' => 'required|integer|min:1',
            'selling_price' => 'required|numeric|min:0'
        ]);

        StockIn::create($validated);

        return redirect()->back()->with('success', 'Stock In added successfully!');
    }

    public function update(Request $request, StockIn $stockIn)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'employee_id' => 'required|exists:employees,id',
            'quantity' => 'required|integer|min:1',
            'selling_price' => 'required|numeric|min:0'
        ]);

        $stockIn->update($validated);

        return redirect()->back()->with('success', 'Stock In updated successfully!');
    }

    public function destroy(StockIn $stockIn)
    {
        $stockIn->delete();

        return redirect()->back()->with('success', 'Stock In deleted successfully!');
    }
}
