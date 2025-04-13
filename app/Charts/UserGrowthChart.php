<?php

namespace App\Charts;

use App\Models\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class UserGrowthChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
        
        $usersData = [];
        $labels = [];
        
        // Get monthly data for the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
            
            $usersData[] = User::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
        }
        
        $this->labels($labels);
        $this->dataset('New Users', 'line', $usersData)
            ->backgroundColor('rgba(153, 102, 255, 0.2)')
            ->Color('rgba(153, 102, 255, 1)');
            
        $this->options([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['beginAtZero' => true]]
                ]
            ]
        ]);
    }
}