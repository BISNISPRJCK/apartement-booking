<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
  // 🔥 GET ALL
  public function index()
  {
    return response()->json(Team::latest()->get());
  }

  // 🔥 STORE
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'position' => 'required',
      'photo' => 'nullable|image'
    ]);

    $photoPath = null;

    if ($request->hasFile('photo')) {
      $photoPath = $request->file('photo')->store('teams', 'public');
    }

    $team = Team::create([
      'name' => $request->name,
      'position' => $request->position,
      'description' => $request->description,
      'photo' => $photoPath
    ]);

    return response()->json($team);
  }

  // 🔥 UPDATE
  public function update(Request $request, $id)
  {
    $team = Team::findOrFail($id);

    if ($request->hasFile('photo')) {
      $photoPath = $request->file('photo')->store('teams', 'public');
      $team->photo = $photoPath;
    }

    $team->update([
      'name' => $request->name ?? $team->name,
      'position' => $request->position ?? $team->position,
      'description' => $request->description ?? $team->description,
    ]);

    return response()->json($team);
  }

  // 🔥 DELETE
  public function destroy($id)
  {
    $team = Team::findOrFail($id);
    $team->delete();

    return response()->json([
      'message' => 'Team deleted'
    ]);
  }
}
