<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate();

        return response()->json([
            'status' =>true,
            'message'=> 'items successfully retrieved',
            'data'=> $items,
        ],200);
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
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Item successfully retrieved.',
            'data' => $item,
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
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found',
            ], 404);
        }

        if ($item->user_id !== auth()->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to delete this item.',
            ], 403);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Item successfully deleted.',
        ], 200);
    }

    public function userItems()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated user.'
            ], 401);
        }

        $items = $user->items;

        return response()->json([
            'status' => true,
            'message' => $items->isEmpty() ? 'No items found' : 'User\'s items successfully retrieved',
            'data' => $items,
        ], 200);
    }

}
