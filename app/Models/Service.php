<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'name',
        'id',
    ];

    public function RoomType()
    {
        return $this->hasMany(RoomType::class, 'img_id', 'id');
    }
}