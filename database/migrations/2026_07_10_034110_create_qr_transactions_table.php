<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_transactions', function (Blueprint $table) {

            $table->id();

$table->integer('batch_id');

$table->string('qr_code')->unique();

$table->enum('egg_size',[
    'Small',
    'Medium',
    'Large',
    'Extra Large',
    'Cracked'
]);

$table->integer('tray_count')->default(10);

$table->integer('eggs_per_tray')->default(30);

$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_transactions');
    }
};