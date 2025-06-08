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
            'image_url' => 'https://s.alicdn.com/@sc04/kf/H50cce48c6ac843bfa9015b338555c461d.jpg_300x300.jpg',
            'user_id' => 1,
        ]);

        Item::create([
            'name' => 'Watch',
            'description' => 'Stylish analog wristwatch.',
            'price' => 250_000,
            'image_url' => 'https://img.joomcdn.net/c8afef2d0065c3d242dc1023d0aca2dfd4ce3c6b_original.jpeg',
            'user_id' => 2,
        ]);

        Item::create([
            'name' => 'Tumbler',
            'description' => 'Stainless steel tumbler with lid.',
            'price' => 100_000,
            'image_url' => 'https://inaexport.id/uploads/Eksportir_Product/Image/16694/1669965622__4.png',
            'user_id' => 3,
        ]);

        Item::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical gaming keyboard.',
            'price' => 450_000,
            'image_url' => 'https://www.softcom.co.id/wp-content/uploads/2021/02/Keyboard-Asus-ROG-Strix-Scope-TKL-Deluxe-1.jpg',
            'user_id' => 4,
        ]);

        Item::create([
            'name' => 'Phone',
            'description' => 'Secondhand iPhone 11, still functional.',
            'price' => 3_5000_000,
            'image_url' => 'https://cdnpro.eraspace.com/media/catalog/product/a/p/apple_iphone_11_white_new_1_1_1.jpg',
            'user_id' => 5,
        ]);
    }
}
