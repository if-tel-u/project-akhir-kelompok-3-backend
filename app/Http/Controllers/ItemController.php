<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUserId = auth()->user()->id;
        $category = $request->query('category');
        $search = $request->query('search');
        $username = $request->query('username');

        try {

        if ($username) {
            $searchedUser = User::where('username', $username)->first();

            if (!$searchedUser) {
                throw new Exception("User with username $username not found.");
            }

            $items = $searchedUser->items;
        } else {
            $items = Item::where('user_id', '!=', $currentUserId)
                    ->where('status', 'listed')
                    ->when($category,fn($query) => $query->where('category', $category))
                    ->when($search, fn($query) => $query->where('name', 'like', "%$search%"))
                    ->orderBy('created_at', 'desc')
                    ->get();
        }

        return response()->json([
            'status' =>true,
            'message'=> 'items successfully retrieved',
            'data'=> $items,
        ],200);
        } catch (Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                404,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('items', 'public'); // simpan di storage/app/public/items
                $data['image_url'] = $imagePath;
            }

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

            $data = $request->validated();

            if ($request->hasFile('image')) {

                if ($item->image_url) {
                    Storage::disk('public')->delete($item->getRawOriginal('image_url'));
                }
                $image = $request->file('image');
                $imagePath = $image->store('items', 'public');
                $data['image_url'] = $imagePath;
            } else  {
                unset($data['image_url']);
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

        if ($item->image_url) {
            Storage::disk('public')->delete($item->getRawOriginal('image_url'));
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
