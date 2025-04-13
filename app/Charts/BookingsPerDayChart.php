<?php

namespace App\Charts;

use App\Models\Booking;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class BookingsPerDayChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
        
        // Get bookings from the last 7 days
        $bookingsData = [];
        $labels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('D');
            
            $bookingsData[] = Booking::whereDate('created_at', $date->toDateString())->count();
        }

        // Then add the dataset - make sure this data is not empty
        if (empty($bookingsData)) {
            $bookingsData = [0, 0, 0, 0, 0, 0, 0]; // Provide default values if no bookings
        }
        
        $this->labels($labels);
        $this->dataset('Bookings', 'line', $bookingsData)
            ->backgroundColor('rgba(54, 162, 235, 0.2)')
            ->Color('rgba(54, 162, 235, 1)');
            
        $this->options([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['beginAtZero' => true]]
                ]
            ]
        ]);
    }
}