<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }


    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'ktp_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('ktp_photo')) {

            // Hapus foto lama jika ada

            if ($user->ktp_photo) {
                Storage::delete($user->ktp_photo);
            }

            $path = $request->file('ktp_photo')->store('ktp', 'public');

            $user->ktp_photo = $path;
        }

        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();

        return response()->json([
            'message' => 'Profile Berhasil diupdate',
            'user' => $user
        ]);
    }
}
