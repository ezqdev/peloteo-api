<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::all();
        return response()->json($sports);
    }

    public function show($id)
    {
        $sport = Sport::find($id);
        if (!$sport) {
            return response()->json(['message' => 'Deporte no encontrado.'], 404);
        }
        return response()->json($sport);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $sport = Sport::create($validated);
        return response()->json($sport, 201);
    }

    public function update(Request $request, $id)
    {
        $sport = Sport::find($id);
        if (!$sport) {
            return response()->json(['message' => 'Deporte no encontrado.'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $sport->update($validated);
        return response()->json($sport);
    }

    public function destroy($id)
    {
        $sport = Sport::find($id);
        if (!$sport) {
            return response()->json(['message' => 'Deporte no encontrado.'], 404);
        }
        $sport->delete();
        return response()->json(['message' => 'Deporte eliminado correctamente.']);
    }
}
