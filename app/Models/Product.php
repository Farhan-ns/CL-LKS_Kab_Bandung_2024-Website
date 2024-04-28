<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
    ];

    protected $appends = [
        'image_link'
    ];

    public function getImageLinkAttribute()
    {
        return asset('img/' . $this->image);
    }
}
