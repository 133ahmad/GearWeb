<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mechanics = Mechanic::all();
        return response()->json($mechanics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mechanics',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:5',
            'status' => 'nullable|integer|in:0,1',
        ]);

        $mechanic = Mechanic::create($validated);
        return response()->json($mechanic, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mechanic = Mechanic::find($id);
        if (!$mechanic) {
            return response()->json(['message' => 'Mechanic not found'], 404);
        }
        return response()->json($mechanic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mechanic = Mechanic::find($id);
        if (!$mechanic) {
            return response()->json(['message' => 'Mechanic not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mechanics,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:5',
            'status' => 'nullable|integer|in:0,1',
        ]);

        $mechanic->update($validated);
        return response()->json($mechanic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mechanic = Mechanic::find($id);
        if (!$mechanic) {
            return response()->json(['message' => 'Mechanic not found'], 404);
        }

        $mechanic->delete();
        return response()->json(['message' => 'Mechanic deleted successfully']);
    }
}
