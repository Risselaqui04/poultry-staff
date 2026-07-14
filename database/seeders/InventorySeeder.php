<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventory')->truncate();

        DB::table('inventory')->insert([

            [
                'item_name' => 'Eggs',
                'category' => 'Egg',
                'quantity' => 7670,
                'unit' => 'pcs',
                'minimum_stock' => 500,
            ],

            [
                'item_name' => 'Feeds',
                'category' => 'Feed',
                'quantity' => 190,
                'unit' => 'sack',
                'minimum_stock' => 150,
            ],

            [
                'item_name' => 'Supplements',
                'category' => 'Supply',
                'quantity' => 150,
                'unit' => 'bottle',
                'minimum_stock' => 50,
            ],

            [
                'item_name' => 'Egg Trays',
                'category' => 'Tray',
                'quantity' => 220,
                'unit' => 'pcs',
                'minimum_stock' => 100,
            ],

        ]);
    }
}