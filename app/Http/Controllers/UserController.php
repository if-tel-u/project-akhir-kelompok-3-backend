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
        //
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
    public function show(string $id)
    {
        $user = User::get()->where("id", $id)->first();

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => "Username with id = {$id} not found.",
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'User successfully retrieved.',
            // 'token' => $user->createToken($user->username)->plainTextToken,
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
