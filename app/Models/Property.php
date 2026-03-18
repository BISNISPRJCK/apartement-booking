<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'price_min',
        'price_max',
        'location',
        'image',
        'bedrooms',
        'bathrooms',
        'area',
        'is_featured'
    ];
    
    protected $casts = [
        'price_min' => 'integer',
        'price_max' => 'integer',
        'is_featured' => 'boolean'
    ];
}