<?php

namespace App\Charts;

use App\Models\Booking;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class RevenueChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
        
        $revenueData = [];
        $labels = [];
        
        // Get monthly revenue for the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
            
            $revenue = Booking::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('status', 'confirmed')
                ->sum('price');
                
            $revenueData[] = $revenue;
        }
        
        $this->labels($labels);
        $this->dataset('Revenue ($)', 'line', $revenueData)
            ->backgroundColor('rgba(75, 192, 192, 0.2)')
            ->Color('rgba(75, 192, 192, 1)');
            
        $this->options([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['beginAtZero' => true]]
                ]
            ]
        ]);
    }
}