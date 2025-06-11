<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        Item::create([
            'name' => 'Laptop',
            'description' => 'Used laptop in good condition.',
            'price' => 5_000_000,
            'category' => 'electronics',
            'image_url' => 'items/laptop.png',
            'user_id' => 1,
        ]);

        Item::create([
            'name' => 'Watch',
            'description' => 'Stylish analog wristwatch.',
            'price' => 250_000,
            'category' => 'fashion',
            'image_url' => 'items/watch.png',
            'user_id' => 2,
        ]);

        Item::create([
            'name' => 'Tumbler',
            'description' => 'Stainless steel tumbler with lid.',
            'price' => 100_000,
            'image_url' => 'items/tumbler.png',
            'user_id' => 3,
        ]);

        Item::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical gaming keyboard.',
            'price' => 450_000,
            'category' => 'electronics',
            'image_url' => 'items/keyboard.png',
            'user_id' => 4,
        ]);

        Item::create([
            'name' => 'Phone',
            'description' => 'Secondhand iPhone 11, still functional.',
            'price' => 3_500_000,
            'category' => 'electronics',
            'image_url' => 'items/iphone.jpg',
            'user_id' => 5,
        ]);
    }
}
