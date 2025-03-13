<?php
use App\Models\Mechanic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmergencyRequestController extends Controller
{
    public function findNearestMechanic(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $mechanic = Mechanic::selectRaw("
            id, name, latitude, longitude,
            ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) 
            * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) 
            * sin( radians( latitude ) ) ) ) AS distance", 
            [$latitude, $longitude, $latitude]
        )
        ->orderBy('distance')
        ->first();

        if (!$mechanic) {
            return response()->json(['message' => 'No mechanics found nearby'], 404);
        }

        return response()->json(['mechanic' => $mechanic]);
    }
}

