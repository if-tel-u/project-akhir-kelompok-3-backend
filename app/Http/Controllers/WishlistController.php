<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = auth()->user();
            $wishlists = $user->wishlists;

            return response()->json([
                'status' => true,
                'message' => 'Wishlists successfully retrieved',
                'data' => $wishlists,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement store wishlist method
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $itemId)
    {
        // TODO: Implement destroy wishlist method
    }
}
