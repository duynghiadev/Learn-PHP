<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(10);
        $data = [
            'packages' => $packages,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function show(string $id)
    {
        $package = Package::find($id);
        if (!$package) {
            $data = [
                'message' => 'Package not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'package' => $package,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $package = Package::create($request->all());
        if (!$package) {
            $data = [
                'message' => 'Package not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'package' => $package,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function update(Request $request, string $id)
    {
        $package = Package::find($id);
        if (!$package) {
            $data = [
                'message' => 'Package not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $package->update($request->all());
        $data = [
            'package' => $package,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy(string $id)
    {
        $package = Package::find($id);
        if (!$package) {
            $data = [
                'message' => 'Package not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $package->delete();
        return response()->json(null, 204);
    }

}
