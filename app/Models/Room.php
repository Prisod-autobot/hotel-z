<?php

namespace App\Models;

use App\Models\RoomBooking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'room_id',
    ];
    public function RoomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'room_id');
    }
}