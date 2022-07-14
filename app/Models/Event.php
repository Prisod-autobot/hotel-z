<?php

namespace App\Models;

use App\Models\EventBooking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function EventBooking()
    {
        return $this->belongsTo(EventBooking::class, 'img_id');
    }
}