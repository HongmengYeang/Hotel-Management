<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    /** @use HasFactory<\Database\Factories\RoomTypeFactory> */
    use HasFactory;

    protected $table = 'room_type';
    protected $fillable = ['type_name', 'description', 'price_per_night'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    
}
