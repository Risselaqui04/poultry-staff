<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_records', function (Blueprint $table) {

            $table->dropForeign(['production_id']);
            $table->dropColumn([
                'production_id',
                'total_eggs',
                'status',
                'scanned_by',
                'scanned_at'
            ]);

        });
    }

    public function down(): void
    {
        Schema::table('qr_records', function (Blueprint $table) {

            $table->foreignId('production_id')->nullable()->constrained('production');

            $table->integer('total_eggs')->default(300);

            $table->enum('status', [
                'Available',
                'Scanned',
                'Dispatched'
            ])->default('Available');

            $table->foreignId('scanned_by')->nullable()->constrained('users');

            $table->timestamp('scanned_at')->nullable();

        });
    }
};