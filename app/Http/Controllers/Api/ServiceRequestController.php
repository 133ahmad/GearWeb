<?php

namespace App\Http\Controllers\Api;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceRequestController extends Controller
{
    public function index()
    {
        return ServiceRequest::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        $serviceRequest = ServiceRequest::create($request->all());
        return response()->json($serviceRequest, 201);
    }

    public function show($id)
    {
        return ServiceRequest::find($id);
    }

    public function update(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::find($id);
        $serviceRequest->update($request->all());
        return response()->json($serviceRequest, 200);
    }

    public function destroy($id)
    {
        ServiceRequest::destroy($id);
        return response()->json(null, 204);
    }
}
