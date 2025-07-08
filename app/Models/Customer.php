<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = ['name', 'email', 'phone',"gender"];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
