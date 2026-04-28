<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index(Request $request)
    {
        $query = Suppliers::query();

        if ($request->search) {
            $query->where('supplier_name', 'like', '%' . $request->search . '%')
                ->orWhere('contact_number', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name'   => 'required|string|max:255',
            'contact_number'  => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
        ]);

        Suppliers::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier added successfully!');
    }

    public function show(Suppliers $supplier)
    {
        return $supplier;
    }

    public function update(Request $request, Suppliers $supplier)
    {
        $validated = $request->validate([
            'supplier_name'   => 'required|string|max:255',
            'contact_number'  => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Suppliers $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully!');
    }
}