<?php

namespace App\Http\Controllers;
use App\Models\Stocks;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index()
    {
        $stocks = Stocks::all();
        return view('stocks.index', compact('stocks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stocks_name' => 'required',
            'cost_price' => 'required|numeric'
        ]);

        Stocks::create($validated);

        return redirect()->back();
    }
    public function show(Stocks $stock)
    {
        return $stock;
    }

    public function update(Request $request, Stocks $stock)
    {
        $validated = $request->validate([
            'stocks_name' => 'required',
            'cost_price' => 'required|numeric'
        ]);

        $stock->update($validated);

        return redirect()->back();
    }

    public function destroy(Stocks $stock)
    {
        $stock->delete();

        return redirect()->back();
    }
}