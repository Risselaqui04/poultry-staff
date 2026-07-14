<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('production')->delete();

        $dates = [
            '2026-07-05',
            '2026-07-06',
            '2026-07-07',
            '2026-07-08',
            '2026-07-09',
            '2026-07-10',
            '2026-07-11',
        ];

        foreach ($dates as $date) {

            for ($batch=1;$batch<=3;$batch++) {

                $small = rand(450,650);
                $medium = rand(900,1100);
                $large = rand(800,1000);
                $xl = rand(180,280);
                $cracked = rand(60,120);

                DB::table('production')->insert([

                    'production_date'=>$date,

                    'batch_id'=>$batch,

                    'small_eggs'=>$small,

                    'medium_eggs'=>$medium,

                    'large_eggs'=>$large,

                    'extra_large_eggs'=>$xl,

                    'cracked_eggs'=>$cracked,

                    'eggs_produced'=>$small+$medium+$large+$xl+$cracked,

                    'created_at'=>Carbon::parse($date),

                    'updated_at'=>Carbon::parse($date),

                ]);

            }

        }

    }
}