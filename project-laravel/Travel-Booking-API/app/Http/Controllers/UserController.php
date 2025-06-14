<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        $data = [
            'users' => $users,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'user' => $user,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'user' => $user,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $user->update($request->all());
        $data = [
            'user' => $user,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }
}
