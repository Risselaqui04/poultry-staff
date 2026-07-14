<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Production;
use App\Models\QrRecord;

class QrTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('qr_transactions')->delete();

        $productions = Production::orderBy('production_date')
            ->orderBy('batch_id')
            ->get();

        foreach ($productions as $production) {

            $sizes = [

                'Small' => $production->small_eggs,

                'Medium' => $production->medium_eggs,

                'Large' => $production->large_eggs,

                'Extra Large' => $production->extra_large_eggs,

                'Cracked' => $production->cracked_eggs,

            ];

            foreach ($sizes as $size => $remainingEggs) {

                $records = QrRecord::where('batch_id', $production->batch_id)
                    ->where('egg_size', $size)
                    ->orderBy('id')
                    ->get();

                foreach ($records as $record) {

                    if ($remainingEggs <= 0) {
                        break;
                    }

                    $eggs = min(300, $remainingEggs);

                    DB::table('qr_transactions')->insert([

                        'qr_record_id' => $record->id,

                        'production_id' => $production->production_id,

                        'total_eggs' => $eggs,

                        'status' => 'Scanned',

                        'scanned_by' => 1,

                        'scanned_at' => $production->production_date,

                        'created_at' => now(),

                        'updated_at' => now(),

                    ]);

                    $remainingEggs -= $eggs;
                }
            }
        }
    }
}