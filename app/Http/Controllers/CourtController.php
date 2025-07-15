<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        return response()->json($courts);
    }

    public function show($id)
    {
        $court = Court::find($id);
        if (!$court) {
            return response()->json(['message' => 'Cancha no encontrada.'], 404);
        }
        return response()->json($court);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'address_lat' => 'nullable|numeric',
            'address_long' => 'nullable|numeric',
            'address_reference' => 'nullable|string',
            'type' => 'required|in:SYNTHETIC,LAND,GRASS',
            'max_players' => 'required|integer',
            'have_parking' => 'required|boolean',
        ]);
        $court = Court::create($validated);
        return response()->json($court, 201);
    }

    public function update(Request $request, $id)
    {
        $court = Court::find($id);
        if (!$court) {
            return response()->json(['message' => 'Cancha no encontrada.'], 404);
        }
        $validated = $request->validate([
            'sport_id' => 'sometimes|required|exists:sports,id',
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'address' => 'sometimes|required|string',
            'address_lat' => 'nullable|numeric',
            'address_long' => 'nullable|numeric',
            'address_reference' => 'nullable|string',
            'type' => 'sometimes|required|in:SYNTHETIC,LAND,GRASS',
            'max_players' => 'sometimes|required|integer',
            'have_parking' => 'sometimes|required|boolean',
        ]);
        $court->update($validated);
        return response()->json($court);
    }

    public function destroy($id)
    {
        $court = Court::find($id);
        if (!$court) {
            return response()->json(['message' => 'Cancha no encontrada.'], 404);
        }
        $court->delete();
        return response()->json(['message' => 'Cancha eliminada correctamente.']);
    }
}
