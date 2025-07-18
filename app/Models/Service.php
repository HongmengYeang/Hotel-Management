<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;
    protected $table = 'service';
    protected $fillable = ['service_name', 'description', 'price'];

    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
}
