<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QrRecord;

class QrRecordSeeder extends Seeder
{
    public function run(): void
    {
        // Clear old QR records
        QrRecord::truncate();

        $sizes = [
            'QRS'  => 'Small',
            'QRM'  => 'Medium',
            'QRL'  => 'Large',
            'QRXL' => 'Extra Large',
            'QRC'  => 'Cracked',
        ];

        foreach ([1, 2, 3] as $batch) {

            foreach ($sizes as $prefix => $size) {

                for ($i = 1; $i <= 100; $i++) {

                    QrRecord::create([
                        'production_id' => null,
                        'batch_id'      => $batch,
                        'qr_code'       => $prefix . '-B' . $batch . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                        'egg_size'      => $size,
                        'tray_count'    => 10,
                        'eggs_per_tray' => 30,
                    ]);

                }

            }

        }
    }
}