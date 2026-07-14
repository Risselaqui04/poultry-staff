<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */
            $this->call([
                ProductionSeeder::class,
                QrRecordSeeder::class,
                QrTransactionSeeder::class,
            ]);
                    DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name' => 'Poultry Staff',
                'email' => 'staff@nbpoultry.com',
                'password' => Hash::make('staff123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        /*
        |--------------------------------------------------------------------------
        | PRODUCTION
        |--------------------------------------------------------------------------
        */

        DB::table('production')->delete();

        DB::table('production')->insert([

            [
                'production_date' => '2026-06-27',
                'batch_id' => 1,
                'small_eggs' => 450,
                'medium_eggs' => 800,
                'large_eggs' => 900,
                'extra_large_eggs' => 250,
                'cracked_eggs' => 60,
                'eggs_produced' => 7150,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-06-28',
                'batch_id' => 1,
                'small_eggs' => 460,
                'medium_eggs' => 820,
                'large_eggs' => 920,
                'extra_large_eggs' => 260,
                'cracked_eggs' => 65,
                'eggs_produced' => 7260,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-06-29',
                'batch_id' => 1,
                'small_eggs' => 470,
                'medium_eggs' => 830,
                'large_eggs' => 930,
                'extra_large_eggs' => 270,
                'cracked_eggs' => 70,
                'eggs_produced' => 7380,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-06-30',
                'batch_id' => 1,
                'small_eggs' => 475,
                'medium_eggs' => 840,
                'large_eggs' => 940,
                'extra_large_eggs' => 280,
                'cracked_eggs' => 75,
                'eggs_produced' => 7450,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-07-01',
                'batch_id' => 1,
                'small_eggs' => 480,
                'medium_eggs' => 850,
                'large_eggs' => 950,
                'extra_large_eggs' => 290,
                'cracked_eggs' => 80,
                'eggs_produced' => 7520,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-07-02',
                'batch_id' => 1,
                'small_eggs' => 485,
                'medium_eggs' => 860,
                'large_eggs' => 960,
                'extra_large_eggs' => 300,
                'cracked_eggs' => 85,
                'eggs_produced' => 7610,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            | TODAY
            */

            [
                'production_date' => '2026-07-03',
                'batch_id' => 1,
                'small_eggs' => 480,
                'medium_eggs' => 850,
                'large_eggs' => 900,
                'extra_large_eggs' => 250,
                'cracked_eggs' => 70,
                'eggs_produced' => 2550,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-07-03',
                'batch_id' => 2,
                'small_eggs' => 350,
                'medium_eggs' => 900,
                'large_eggs' => 1050,
                'extra_large_eggs' => 180,
                'cracked_eggs' => 90,
                'eggs_produced' => 2570,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'production_date' => '2026-07-03',
                'batch_id' => 3,
                'small_eggs' => 400,
                'medium_eggs' => 750,
                'large_eggs' => 1100,
                'extra_large_eggs' => 220,
                'cracked_eggs' => 80,
                'eggs_produced' => 2550,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | INVENTORY
        |--------------------------------------------------------------------------
        */

        DB::table('inventory')->delete();

        DB::table('inventory')->insert([

            [
                'item_name' => 'Eggs',
                'category' => 'Egg',
                'quantity' => 2400,
                'unit' => 'pcs',
                'minimum_stock' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'item_name' => 'Feeds',
                'category' => 'Feeds',
                'quantity' => 190,
                'unit' => 'sack',
                'minimum_stock' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'item_name' => 'Supplements',
                'category' => 'Medicine',
                'quantity' => 150,
                'unit' => 'bottle',
                'minimum_stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'item_name' => 'Egg Trays',
                'category' => 'Packaging',
                'quantity' => 220,
                'unit' => 'tray',
                'minimum_stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}