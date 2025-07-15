<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado.'], 404);
        }
        return response()->json($profile);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'current_location_lat' => 'nullable|numeric',
            'current_location_long' => 'nullable|numeric',
            'avatar_url' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'ci' => 'nullable|string|max:10',
            'ci_url' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'extra_phone_number' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $validated['user_id'] = $request->user()->id;
        $profile = Profile::create($validated);
        return response()->json($profile, 201);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado.'], 404);
        }
        if ($profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }
        $validated = $request->validate([
            'country' => 'sometimes|required|string',
            'state' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'current_location_lat' => 'nullable|numeric',
            'current_location_long' => 'nullable|numeric',
            'avatar_url' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'ci' => 'nullable|string|max:10',
            'ci_url' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'extra_phone_number' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $profile->update($validated);
        return response()->json($profile);
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado.'], 404);
        }
        $profile->delete();
        return response()->json(['message' => 'Perfil eliminado correctamente.']);
    }
}
