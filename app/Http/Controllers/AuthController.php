<?php

namespace App\Http\Controllers\Auth;

use App\Models\Mechanic;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Register new user (Mechanic or Customer)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:mechanics,phone|unique:customers,phone',
            'password' => 'required|min:6',
            'user_type' => 'required|in:mechanic,customer',  // User type can be mechanic or customer
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);  // Return validation errors
        }

        // Register the user based on the user_type
        $user = null;
        if ($request->user_type == 'mechanic') {
            $user = Mechanic::create([
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        } elseif ($request->user_type == 'customer') {
            $user = Customer::create([
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        }

        if (!$user) {
            return response()->json(['message' => 'User registration failed.'], 500);  // In case something goes wrong
        }

        return response()->json(['message' => 'User registered successfully.'], 201);  // Success response
    }

    // User login method
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
            'user_type' => 'required|in:mechanic,customer',  // Ensure user_type is provided
        ]);

        // Determine which model to query based on user_type
        $user = null;
        if ($request->user_type == 'mechanic') {
            $user = Mechanic::where('phone', $request->phone)->first();
        } elseif ($request->user_type == 'customer') {
            $user = Customer::where('phone', $request->phone)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);  // Invalid login details
        }

        // Generate token using Laravel Passport or JWT
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json(['token' => $token], 200);  // Return the generated token
    }
}
