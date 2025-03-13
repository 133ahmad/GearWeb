<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mechanic_id' => 'required|exists:mechanics,id',
            'appointment_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $appointment = Appointment::create([
            'customer_id' => auth()->id(),
            'mechanic_id' => $request->mechanic_id,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Appointment requested successfully!', 'appointment' => $appointment], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:accepted,rejected']);

        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return response()->json(['message' => 'Appointment updated!', 'appointment' => $appointment]);
    }
}
