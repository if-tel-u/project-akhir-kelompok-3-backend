<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = auth()->user();

            return response()->json([
                'status' => true,
                'message' => 'Successfully retrieved current user data.',
                'data' => $user,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = User::find($id)->only(['username', 'fullname']);

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => "Username with id = {$id} not found.",
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'User successfully retrieved.',
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        try {
            $data = $request->validated();
            $user = auth()->user();
            $user->update($data);

            return response()->json([
                'status' => true,
                'message' => 'User successfully updated.',
                'data' => $user,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => "User with id = {$user->id} not found.",
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => "User with id = {$user->id} has been deleted.",
        ], 200);
    }
}
