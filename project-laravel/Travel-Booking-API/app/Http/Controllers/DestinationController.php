<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{

    public function index()
    {
        $destinations = Destination::paginate(10);
        $data = [
            'destinations' => $destinations,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function show(string $id)
    {
        $destination = Destination::find($id);
        if (!$destination) {
            $data = [
                'message' => 'Destination not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'destination' => $destination,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy(string $id)
    {
        $destination = Destination::find($id);
        if (!$destination) {
            $data = [
                'message' => 'Destination not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $destination->delete();
        return response()->json(null, 204);
    }

    public function store(Request $request)
    {
        $destination = Destination::create($request->all());
        if (!$destination) {
            $data = [
                'message' => 'Destination not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'destination' => $destination,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function update(Request $request, string $id)
    {
        $destination = Destination::find($id);
        if (!$destination) {
            $data = [
                'message' => 'Destination not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $destination->update($request->all());
        $data = [
            'destination' => $destination,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
