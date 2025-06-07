<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get top selling products with their total quantities sold
            $topProducts = OrderItem::with('product')
                ->selectRaw('productId, sum(quantity) as total_sold')
                ->groupBy('productId')
                ->orderByDesc('total_sold')
                ->take(10) // Limit to top 10 products
                ->get();

            // Log the query results for debugging
            Log::info('Top Products Query Results:', ['count' => $topProducts->count()]);

            // Prepare data for Chart.js
            $chartData = [
                'labels' => $topProducts->pluck('product.name'),
                'data' => $topProducts->pluck('total_sold'),
                'backgroundColors' => $this->generateChartColors($topProducts->count())
            ];

            // Log the chart data for debugging
            Log::info('Chart Data:', $chartData);

            return view('admin.dashboard', compact('topProducts', 'chartData'));
        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard')->with('error', 'Unable to load sales data. Please try again later.');
        }
    }

    private function generateChartColors($count)
    {
        $colors = [];
        $baseColors = [
            '#4e73df',
            '#1cc88a',
            '#36b9cc',
            '#f6c23e',
            '#e74a3b',
            '#5a5c69',
            '#858796',
            '#3a3b45',
            '#f8f9fc',
            '#e83e8c'
        ];

        for ($i = 0; $i < $count; $i++) {
            $colors[] = $baseColors[$i % count($baseColors)];
        }

        return $colors;
    }
}
