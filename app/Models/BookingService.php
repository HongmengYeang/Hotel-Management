<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;

    protected $table = 'booking_service';

    protected $fillable = [
        'booking_id',
        'service_id',
        'quantity',
        'total_price',
    ];

    /**
     * Get the booking that owns the service.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the service that belongs to the booking.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
