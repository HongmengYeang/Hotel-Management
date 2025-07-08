<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = "booking_detail";
    protected $fillable = [
        "booking_id",
        "booking_date",
        "check_in_date",
        "check_out_date",
        "price",
        "description"
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
