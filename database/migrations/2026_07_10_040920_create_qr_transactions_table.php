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

            $table->unsignedBigInteger('qr_record_id');

            $table->unsignedBigInteger('production_id');

            $table->integer('total_eggs');

            $table->enum('status',[
                'Scanned',
                'Edited'
            ])->default('Scanned');

            $table->unsignedBigInteger('scanned_by')->nullable();

            $table->timestamp('scanned_at');

            $table->timestamps();

            $table->foreign('qr_record_id')
                  ->references('id')
                  ->on('qr_records')
                  ->cascadeOnDelete();

            $table->foreign('production_id')
                  ->references('production_id')
                  ->on('production')
                  ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_transactions');
    }
};