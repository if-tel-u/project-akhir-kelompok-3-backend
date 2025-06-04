<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Throwable;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        $items = Item::when(
            $category,
            fn($query) => $query->where('category', $category)
        )->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' =>true,
            'message'=> 'items successfully retrieved',
            'data'=> $items,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $item = Item::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Item successfully created.',
                'data' => $item,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
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
    public function update(UpdateItemRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $item = Item::find($id);

            if (!$item) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item not found.',
                ], 404);
            }

            if ($item->user_id !== auth()->user()->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to update this item.',
                ], 403);
            }

            $item->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Item successfully updated.',
                'data' => $item,
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
