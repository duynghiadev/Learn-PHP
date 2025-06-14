<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Registra un nuevo usuario y genera un token API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ],
                400
            );
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User created successfull',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    /**
     * Inicia sesión y genera un token API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized']
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'data' =>  $user,
            'token' => $token
        ], 200);
    }

    /**
     * Obtiene la información del usuario autenticado
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Cierra la sesión y elimina el token API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'User logged out successfully'
        ], 200);
    }
}
