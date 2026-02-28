<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Accommodation bookings table for Umrah/Ziyarat stays.
 * Supports both guest and logged-in user bookings.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->unsignedSmallInteger('nights');
            $table->unsignedSmallInteger('adults');
            $table->unsignedSmallInteger('kids')->default(0);
            $table->decimal('price_per_night', 12, 2);
            $table->foreignId('chauffeur_service_id')->nullable()->constrained('chauffeur_services')->nullOnDelete();
            $table->decimal('chauffeur_price', 12, 2)->default(0)->comment('Extra chauffeur cost when luxury (non-default) selected');
            $table->string('arrival_airport', 20)->nullable();
            $table->string('flight_number', 50)->nullable();
            $table->decimal('total_price', 12, 2);
            $table->string('status', 20)->default('pending')->comment('pending, confirmed, cancelled');
            $table->string('reference', 32)->unique()->comment('Booking reference for customer');
            $table->timestamps();

            $table->index(['accommodation_id', 'check_in_date', 'check_out_date']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
