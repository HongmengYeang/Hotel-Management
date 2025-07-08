<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;
    protected $table = 'room';
    protected $fillable = ['room_number', 'room_type_id', 'is_available',"capacity","floor","description"];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    

}
