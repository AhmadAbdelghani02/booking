<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.min.css">
    <style>
        :root {
            --primary-color: #1e95d4;
            --secondary-color: #7dd1df;
            --light-color: #b5e5e7;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 10px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: bold;
            border-bottom: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #1780b9;
            border-color: #1780b9;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .badge.bg-info {
            background-color: var(--secondary-color) !important;
        }
        
        .hotel-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .hotel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }
        
        .amenities-icon {
            color: var(--primary-color);
            margin-right: 8px;
            width: 24px;
            text-align: center;
        }
        
        .sticky-booking {
            position: sticky;
            top: 20px;
        }
        
        .form-control, .form-select {
            padding: 10px;
            border-radius: 8px;
        }
        
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(30, 149, 212, 0.7);
            border-radius: 50%;
            padding: 25px;
        }
        
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary-color);
        }
        
        .similar-hotel-img {
            height: 180px;
            object-fit: cover;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
        }
        
        .feature-icon {
            font-size: 1.2rem;
            margin-right: 5px;
            color: var(--primary-color);
        }
        
        .price-tag {
            position: relative;
            display: inline-block;
            padding: 5px 10px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
        }
        
        .review-badge {
            padding: 5px 8px;
            border-radius: 4px;
            font-weight: bold;
            background-color: #28a745;
            color: white;
        }
        
        /* Map Style */
        #hotelMap {
            height: 400px;
            width: 100%;
            border-radius: 8px;
        }
        
        .map-marker-label {
            background-color: white;
            border-radius: 4px;
            padding: 5px 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Hotel Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="mb-3"><i class="fas fa-hotel me-2 text-primary"></i>{{ $hotel->name }}</h1>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-info me-2">
                                    <i class="fas fa-map-marker-alt"></i> {{ $hotel->region->name }}
                                </span>
                                <span class="review-badge me-2">
                                    <i class="fas fa-thumbs-up"></i> 8.9/10
                                </span>
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $hotel->stars)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                            </div>
                            <div class="price-tag">
                                <i class="fas fa-tag me-1"></i> {{ number_format($hotel->price_per_night) }} $ / night
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hotel Images Gallery -->
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @if($hotel->images->count() > 0)
                                    @foreach($hotel->images as $key => $image)
                                        <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></button>
                                    @endforeach
                                @else
                                    <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="0" class="active"></button>
                                @endif
                            </div>
                            <div class="carousel-inner">
                                @if($hotel->images->count() > 0)
                                    @foreach($hotel->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->image) }}" class="d-block w-100" alt="{{ $hotel->name }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img src="{{ asset($hotel->image) }}" class="d-block w-100" alt="{{ $hotel->name }}">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Hotel Description -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Hotel Description</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $hotel->description }}</p>
                    </div>
                </div>
                
                <!-- Amenities -->
                @if($hotel->amenities)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>Amenities & Services</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                            $amenities = explode(',', $hotel->amenities);
                            @endphp
                            @foreach($amenities as $amenity)
                                <div class="col-md-4 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas {{ $amenity }} amenities-icon"></i> {{ trim($amenity) }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-wifi amenities-icon"></i> Free WiFi
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-swimming-pool amenities-icon"></i> Swimming Pool
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-dumbbell amenities-icon"></i> Fitness Center
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-utensils amenities-icon"></i> Restaurant
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-spa amenities-icon"></i> Spa
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-parking amenities-icon"></i> Free Parking
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Hotel Features -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Hotel Features</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock feature-icon"></i> 24-hour front desk
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-credit-card feature-icon"></i> Accepts credit cards
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-baby feature-icon"></i> Family friendly
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-paw feature-icon"></i> Pet friendly
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-smoking-ban feature-icon"></i> Non-smoking rooms
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-wheelchair feature-icon"></i> Accessible
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Location Map -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Location</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $hotel->address }}</p>
                        <div id="hotelMap"></div>
                    </div>
                </div>
                
                <!-- Guest Reviews -->
               
            </div>
            
            <div class="col-lg-4">
                <!-- Booking Form -->
                <div class="card sticky-booking">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Book Now</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-plane-arrival me-1"></i> Check-in Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-plane-departure me-1"></i> Check-out Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-door-open me-1"></i> Number of Rooms</label>
                                <select class="form-select">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-user me-1"></i> Number of Adults</label>
                                <select class="form-select">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-child me-1"></i> Number of Children</label>
                                <select class="form-select">
                                    @for($i = 0; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-check-circle me-1"></i> Confirm Booking</button>
                        </form>
                        
                        <!-- Special Offers -->
                        <div class="mt-4">
                            <h6 class="mb-2"><i class="fas fa-gift text-primary me-1"></i> Special Offers</h6>
                            <div class="d-flex align-items-center mb-2 p-2 bg-light rounded">
                                <i class="fas fa-percent text-success me-2"></i>
                                <div>10% off for stays longer than 3 nights</div>
                            </div>
                            <div class="d-flex align-items-center p-2 bg-light rounded">
                                <i class="fas fa-utensils text-warning me-2"></i>
                                <div>Free breakfast for loyalty members</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Similar Hotels -->
        @if($similarHotels->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4"><i class="fas fa-building me-2"></i>Similar Hotels You May Like</h3>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($similarHotels as $similarHotel)
                <div class="col">
                    <div class="card h-100 hotel-card">
                        <img src="{{ asset($similarHotel->image) }}" class="card-img-top similar-hotel-img" alt="{{ $similarHotel->name }}">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-hotel text-primary me-1"></i> {{ $similarHotel->name }}</h5>
                            <p class="card-text mb-1">
                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $similarHotel->region->name }}
                            </p>
                            <p class="card-text mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $similarHotel->stars)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </p>
                            <p class="card-text text-primary fw-bold">
                                <i class="fas fa-tag me-1"></i> {{ number_format($similarHotel->price_per_night) }} $ / night
                            </p>
                            <a href="{{ route('hotels.show', $similarHotel->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-info-circle me-1"></i> View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <!-- Newsletter Subscription -->
         
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Jordan coordinates for the map center if hotel coordinates are not available
            var defaultLat = 31.9454;
            var defaultLng = 35.9284;
            
            // Get hotel coordinates from database (latitude and longitude)
            var hotelLat = {{ $hotel->latitude ?? 'defaultLat' }};
            var hotelLng = {{ $hotel->longitude ?? 'defaultLng' }};
            var hotelName = "{{ $hotel->name }}";
            
            // Initialize map
            var map = L.map('hotelMap').setView([hotelLat, hotelLng], 15);
            
            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Add marker for hotel location
            var marker = L.marker([hotelLat, hotelLng]).addTo(map);
            
            // Add popup with hotel name and address
            marker.bindPopup("<b>" + hotelName + "</b><br>" + "{{ $hotel->address }}").openPopup();
            
            // Add custom icon if needed
            /*
            var hotelIcon = L.icon({
                iconUrl: '{{ asset("images/hotel-marker.png") }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            
            var marker = L.marker([hotelLat, hotelLng], {icon: hotelIcon}).addTo(map);
            */
            
            // Jordan regions with approximate coordinates - for reference
            var jordanRegions = {
                'Amman': [31.9454, 35.9284],
                'Aqaba': [29.5267, 35.0077],
                'Dead Sea': [31.5497, 35.4675],
                'Petra': [30.3285, 35.4444],
                'Wadi Rum': [29.5833, 35.4167],
                'Jerash': [32.2808, 35.8917],
                'Irbid': [32.5556, 35.8500],
                'Madaba': [31.7167, 35.8000],
                'Ajloun': [32.3333, 35.7500],
                'Zarqa': [32.0667, 36.1000]
            };
            
            // Use region coordinates as fallback if specific hotel coordinates are not available
            if (typeof hotelLat === 'undefined' || typeof hotelLng === 'undefined') {
                var region = "{{ $hotel->region->name }}";
                if (jordanRegions[region]) {
                    var regionCoords = jordanRegions[region];
                    map.setView(regionCoords, 13);
                    L.marker(regionCoords).addTo(map)
                        .bindPopup("<b>" + hotelName + "</b><br>" + region + ", Jordan").openPopup();
                } else {
                    map.setView([defaultLat, defaultLng], 8);
                    L.marker([defaultLat, defaultLng]).addTo(map)
                        .bindPopup("Jordan").openPopup();
                }
            }
        });
    </script>
</body>
</html>
 
