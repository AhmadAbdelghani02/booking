@extends('layouts.admin')

@section('style')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('title')
    Admin : Charts
@endsection

@section('content')
                  {{-- Table --}}
              <div class="container" style="max-height: 100%">
                <div class="my-3">
                  <h3>
                    <i class="bi bi-graph-up"></i>
                    Charts
                  </h3>
                </div>
                
    

    <!-- Charts section -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="card chart w-100 h-75">
                <div class="card-header">Bookings Last 7 Days</div>
                <div class="card-body" style="height: 400px">
                    {!! $bookingsChart->container() !!}
                </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card chart w-100 h-75">
                <div class="card-header">User Growth (Monthly)</div>
                <div class="card-body" style="height: 400px">
                    {!! $userGrowthChart->container() !!}
                </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card chart w-100 h-75">
                <div class="card-header">Revenue by Month</div>
                <div class="card-body" style="height: 400px">
                    {!! $revenueChart->container() !!}
                </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card chart w-100 h-75">
                <div class="card-header">Bookings Status</div>
                <div class="card-body" style="height: 400px">
                    {!! $bookingStatusChart->container() !!}
                </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev top-50" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next top-50" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

        
        

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<!-- Load chart scripts -->
{!! $bookingsChart->script() !!}
{!! $revenueChart->script() !!}
{!! $bookingStatusChart->script() !!}
{!! $userGrowthChart->script() !!}
                @endsection
<script src="/js/admin.js"></script>