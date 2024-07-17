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
        Schema::create('vehicle_usage_records', function (Blueprint $table) {
            $table->id('record_id')->primary();
            $table->unsignedBigInteger('reservation_id');
            $table->float('fuel_consumption', 2);
            $table->float('distance_traveled', 2);
            $table->timestamp('created_at')->useCurrent();
            $table->date('start_date');
            $table->date('end_date');

            $table->foreign('reservation_id')->references('reservation_id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_usage_records');
    }
};
