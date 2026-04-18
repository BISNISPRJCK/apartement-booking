<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_category_id',
        'type',
        'price',
        'status',
        'description',
        'image',
        'capacity'
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function bookins()
    {
        return $this->hasMany(Booking::class);
    }

    public function features()
    {
        return $this->belongsToMany(
            \App\Models\RoomFeature::class,
            'room_feature_room', // 🔥 NAMA TABEL PIVOT
            'room_id',
            'room_feature_id'
        );
    }
}
