<?php

namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAll extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'caption',
        'post_id',
    ];

    public function roomtype()
    {
        return $this->belongsTo(Images::class);
    }
}