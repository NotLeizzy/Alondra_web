<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\ViewStockInSummary;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats for Cards
        $totalItems = StockIn::sum('quantity');
        $totalCost = ViewStockInSummary::sum('total_cost_value');
        
        // Potential Revenue: sum(quantity * selling_price)
        $potentialRevenue = DB::table('stock_in')->selectRaw('SUM(quantity * selling_price) as total')->value('total') ?? 0;
        
        $potentialProfit = $potentialRevenue - $totalCost;
        $profitMargin = $potentialRevenue > 0 ? ($potentialProfit / $potentialRevenue) * 100 : 0;

        // Data for Charts
        // Stock Cost Over Time (grouped by date)
        $costOverTime = ViewStockInSummary::select(
                DB::raw('DATE(date_received) as date'),
                DB::raw('SUM(total_cost_value) as total_cost')
            )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Recent Stock-In Records for the table
        $recentStockIns = ViewStockInSummary::orderBy('date_received', 'DESC')->limit(5)->get();

        // Stock Distribution (Grouped by Product for the Bar Chart)
        $stockDistribution = ViewStockInSummary::select('products_name', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('products_name')
            ->orderBy('total_quantity', 'DESC')
            ->limit(8)
            ->get();

        return view('dashboard', compact(
            'totalItems', 
            'totalCost', 
            'potentialRevenue', 
            'potentialProfit', 
            'profitMargin',
            'costOverTime',
            'recentStockIns',
            'stockDistribution'
        ));
    }
}
