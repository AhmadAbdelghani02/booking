<?php

namespace App\Charts;

use App\Models\Booking;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class BookingStatusChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
        
        $confirmed = Booking::where('status', 'confirmed')->count();
        $pending = Booking::where('status', 'pending')->count();
        $cancelled = Booking::where('status', 'cancelled')->count();
        
        $this->labels(['Confirmed', 'Pending', 'Cancelled']);
        $this->dataset('Booking Status', 'pie', [$confirmed, $pending, $cancelled])
            ->backgroundColor([
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(255, 99, 132, 0.6)'
            ]);
            
        $this->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
        ]);
    }
}