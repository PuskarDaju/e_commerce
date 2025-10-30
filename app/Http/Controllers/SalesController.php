<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SalesController extends Controller
{
    public function index(){
             $salesData = Sale::selectRaw('
                MONTH(created_at) as month,
                SUM(total_amount) as total
            ')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

            $chartData = [];
            $chartLabels = [];
            foreach ($salesData as $sale) {
            $chartLabels[] = date('F', mktime(0, 0, 0, $sale->month, 1)); // Convert month number to name
            $chartData[] = $sale->total;
            }

            return view('sales.index', compact('chartLabels', 'chartData'));
    }
}
