<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
    protected $fillable = [
        'name'
    ];


    public function rooms()
    {
        return $this->belongsToMany(
            \App\Models\Room::class,
            'room_feature_room',
            'room_feature_id',
            'room_id'
        );
    }
}
