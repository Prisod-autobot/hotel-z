<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public function relationImage()
    {
        return $this->hasMany(Images::class, 'id', 'img_id');
    }

    public function relationService()
    {
        return $this->hasMany(Service::class, 'id', 'room_service');
    }

    public function Images()
    {
        return $this->belongsTo(Images::class);
    }

    public function Room()
    {
        return $this->belongsTo(Room::class, 'room_type_id');
    }
}