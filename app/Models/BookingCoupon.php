<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingCoupon extends Model
{
    use HasFactory;

    protected $table = 'booking_coupons';
    protected $fillable = ['booking_id', 'coupon_id'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}