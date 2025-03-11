<?php
use App\Models\Mechanic;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:mechanics,phone|unique:customers,phone',
            'password' => 'required|min:6',
            'user_type' => 'required|in:mechanic,customer',  // Add user_type field
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Register the user based on the user_type
        if ($request->user_type == 'mechanic') {
            $user = Mechanic::create([
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $user = Customer::create([
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        }

        // Return success response
        return response()->json(['message' => 'User registered successfully.'], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
            'user_type' => 'required|in:mechanic,customer',  // Add user_type field
        ]);

        // Determine which model to query based on user_type
        if ($request->user_type == 'mechanic') {
            $user = Mechanic::where('phone', $request->phone)->first();
        } else {
            $user = Customer::where('phone', $request->phone)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        // Assuming you are using Passport or JWT for authentication
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
