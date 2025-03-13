<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'RegistrationDate' => 'nullable|date',
            'status' => 'nullable|integer|in:0,1',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'RegistrationDate' => 'nullable|date',
            'status' => 'nullable|integer|in:0,1',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }

    /**
     * Update Customer Location.
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $customer = Customer::find(auth()->id()); // Assuming authentication is used
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['message' => 'Location updated successfully.']);
    }
}
