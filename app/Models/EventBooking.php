<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'img_id',
    ];

    public function Event()
    {
        return $this->hasMany(Event::class, 'img_id');
    }
}