<?php

namespace App\Models;

use App\Models\ImageAll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'id',
        'name',
    ];

    public function images()
    {
        return $this->hasMany(ImageAll::class);
    }
}