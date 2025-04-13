<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Booking;
use App\Charts\BookingsPerDayChart;
use App\Charts\TopHotelsChart;
use App\Charts\BookingStatusChart;
use App\Charts\UserGrowthChart;
use App\Charts\RevenueChart;
use App\Charts\RegionDistributionChart;

use Illuminate\Http\Request;



class AdminChartsController extends Controller
{
    public function index()
    {
        // Quick stats
        $totalUsers = User::count();
        $totalHotels = Hotel::count();
        $totalBookings = Booking::count();
        $revenue = Booking::where('status', 'confirmed')->sum('price');
        
        // Create chart instances
        $bookingsChart = new BookingsPerDayChart;
        $revenueChart = new RevenueChart;
        $bookingStatusChart = new BookingStatusChart;
        $userGrowthChart = new UserGrowthChart;
        
        return view('admin.charts.index', compact(
            'totalUsers', 'totalHotels', 'totalBookings', 'revenue',
            'bookingsChart', 'revenueChart', 'bookingStatusChart', 'userGrowthChart'
        ));
    }
}
