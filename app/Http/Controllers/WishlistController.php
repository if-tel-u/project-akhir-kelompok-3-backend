<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishlistRequest;
use App\Models\Item;
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
                // Ambil semua wishlist lengkap dengan relasi item-nya
                $wishlists = $user->wishlists()->with('item')->get();

                // Ambil data item-nya saja dari relasi wishlist
                $items = $wishlists->pluck('item')->filter()->values(); // filter() untuk skip null (item yang mungkin sudah dihapus)

                return response()->json([
                    'status' => true,
                    'message' => 'Wishlist items successfully retrieved',
                    'data' => $items, // langsung data item
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
    public function store(StoreWishlistRequest $request)
    {
        try {
            $user = auth()->user();
            $itemId = $request->validated()['item_id'];
            $item = Item::find($itemId);

            if (!$item) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item not found.',
                ], 404);
            }

            $existingWishlist = $user->wishlists()->where('item_id', $itemId)->first();

            if ($existingWishlist) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item already exists in the wishlist.',
                ], 400);
            }

            if ($item->user_id == $user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot add wishlist of its own item.',
                ], 400);
            }

            $wishlist = $user->wishlists()->create(['item_id' => $itemId]);

            return response()->json([
                'status' => true,
                'message' => 'Item successfully added to the wishlist.',
                'data' => $wishlist,
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
        try {
            $user = auth()->user();
            $wishlist = $user->wishlists()->where('item_id', $itemId)->first();

            if (!$wishlist) {
                return response()->json([
                    'status' => false,
                    'message' => 'Wishlist not found.',
                ], 404);
            }

            $wishlist->delete();

            return response()->json([
                'status' => true,
                'message' => 'Wishlist successfully deleted.',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
