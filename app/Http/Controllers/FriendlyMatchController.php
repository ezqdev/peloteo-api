<?php

namespace App\Http\Controllers;

use App\Models\FriendlyMatch;
use Illuminate\Http\Request;

class FriendlyMatchController extends Controller
{
    public function index()
    {
        $matches = FriendlyMatch::all();
        return response()->json($matches);
    }

    public function show($id)
    {
        $match = FriendlyMatch::find($id);
        if (!$match) {
            return response()->json(['message' => 'Partido no encontrado.'], 404);
        }
        return response()->json($match);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'court_id' => 'required|exists:courts,id',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i:s',
            'status' => 'required|in:ACCEPTED,CANCELED',
        ]);
        $match = FriendlyMatch::create($validated);
        // Asociar el usuario autenticado como participante del partido
        $match->users()->attach($request->user()->id);
        return response()->json($match->load('users'), 201);
    }

    public function update(Request $request, $id)
    {
        $match = FriendlyMatch::find($id);
        if (!$match) {
            return response()->json(['message' => 'Partido no encontrado.'], 404);
        }
        $validated = $request->validate([
            'sport_id' => 'sometimes|required|exists:sports,id',
            'court_id' => 'sometimes|required|exists:courts,id',
            'date' => 'sometimes|required|date',
            'hour' => 'sometimes|required|date_format:H:i:s',
            'status' => 'sometimes|required|in:ACCEPTED,CANCELED',
        ]);
        $match->update($validated);
        return response()->json($match);
    }

    public function destroy($id)
    {
        $match = FriendlyMatch::find($id);
        if (!$match) {
            return response()->json(['message' => 'Partido no encontrado.'], 404);
        }
        $match->delete();
        return response()->json(['message' => 'Partido eliminado correctamente.']);
    }

    public function join(Request $request, $id)
    {
        $match = FriendlyMatch::find($id);
        if (!$match) {
            return response()->json(['message' => 'Partido no encontrado.'], 404);
        }
        if ($match->users()->where('user_id', $request->user()->id)->exists()) {
            return response()->json(['message' => 'Ya eres participante de este partido.'], 409);
        }
        $match->users()->attach($request->user()->id);
        return response()->json(['message' => 'Te has unido al partido.']);
    }

    public function leave(Request $request, $id)
    {
        $match = FriendlyMatch::find($id);
        if (!$match) {
            return response()->json(['message' => 'Partido no encontrado.'], 404);
        }
        if (! $match->users()->where('user_id', $request->user()->id)->exists()) {
            return response()->json(['message' => 'No eres participante de este partido.'], 409);
        }
        $match->users()->detach($request->user()->id);
        return response()->json(['message' => 'Has salido del partido.']);
    }
}
