<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = new User($data);

        $user->password = Hash::make($data['password']);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Register account successfully.',
            'token' => $user->createToken('api-token')->plainTextToken,
            'data' => $user,
        ], 200);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $user = User::where('username', $data['username'])->first();

            if (empty($user)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Username not found.',
                ], 200);
            }

            if (!Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password does not match.',
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'Login successfully.',
                'token' => $user->createToken('api-token')->plainTextToken,
                'data' => $user,
            ], 200);
        } catch (Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                500
            );
        }
    }

    public static function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully.',
        ], 200);
    }

    public static function checkToken()
    {
        try {
            $isAuthenticated = auth()->check();

            if ($isAuthenticated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Token is valid',
                ], 200);
            }

            return response()->json([
                'message' => 'Token is invalid or expired',
                'status' => false
            ], 401);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
