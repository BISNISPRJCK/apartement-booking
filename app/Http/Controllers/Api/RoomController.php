<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function Index()
    {
        $rooms = Room::with('category')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Rooms',
            'data' => $rooms
        ]);
    }

    public function show($id)
    {
        $room = Room::with('category')->find($id);

        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $room
        ]);
    }
}
