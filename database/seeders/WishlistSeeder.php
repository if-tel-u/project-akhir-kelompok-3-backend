<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        Wishlist::create([
            'user_id' => 1,
            'item_id' => 2,
        ]);
        Wishlist::create([
            'user_id' => 2,
            'item_id' => 3,
        ]);
        Wishlist::create([
            'user_id' => 3,
            'item_id' => 4,
        ]);
        Wishlist::create([
            'user_id' => 4,
            'item_id' => 5,
        ]);
        Wishlist::create([
            'user_id' => 5,
            'item_id' => 1,
        ]);
    }
}
