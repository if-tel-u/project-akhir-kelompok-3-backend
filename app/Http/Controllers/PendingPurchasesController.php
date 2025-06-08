<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendingPurchasesRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Throwable;

class PendingPurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            try {
                $user = auth()->user();
                $pendingPurchases = $user->pendingPurchases()->with('item')->get();
                $items = $pendingPurchases->pluck('item')->filter()->values();

                return response()->json([
                    'status' => true,
                    'message' => 'Pending purchased items successfully retrieved',
                    'data' => $items,
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
    public function store(StorePendingPurchasesRequest $request)
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

            $existingPendingPurchases = $user->pendingPurchases()
                    ->where('item_id', $itemId)
                    ->first();

            if ($existingPendingPurchases) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item already exists in pending purchases.',
                ], 400);
            }

            if ($item->user_id == $user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot add purchase of its own item.',
                ], 400);
            }

            $pendingPurchases = $user->pendingPurchases()
                    ->create(['item_id' => $itemId]);

            return response()->json([
                'status' => true,
                'message' => 'Item successfully added to pending purchases.',
                'data' => $pendingPurchases,
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
            $pendingPurchases = $user->pendingPurchases()
                    ->where('item_id', $itemId)
                    ->first();

            if (!$pendingPurchases) {
                return response()->json([
                    'status' => false,
                    'message' => 'Purchases not found.',
                ], 404);
            }

            $pendingPurchases->delete();

            return response()->json([
                'status' => true,
                'message' => 'Pending purchase successfully deleted.',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
