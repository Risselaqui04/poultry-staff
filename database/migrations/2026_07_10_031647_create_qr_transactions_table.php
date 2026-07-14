<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('qr_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::create('qr_transactions', function (Blueprint $table) {

    $table->id();

    $table->foreignId('qr_record_id')
          ->constrained('qr_records')
          ->cascadeOnDelete();

    $table->unsignedBigInteger('production_id');

    $table->date('production_date');

    $table->integer('total_eggs');

    $table->foreignId('worker_id')
          ->nullable()
          ->constrained('users')
          ->nullOnDelete();

    $table->timestamps();

});
    }
};
