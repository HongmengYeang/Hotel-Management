<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
     protected $table = 'booking';
    protected $fillable = ['customer_id',"room_id"];

    public function bookingDetail()
    {
        return $this->hasOne(BookingDetail::class, 'booking_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function services()
    {
        return $this->hasMany(BookingService::class);
    }
}
