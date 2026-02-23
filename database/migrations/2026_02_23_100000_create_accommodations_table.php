<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type', 50); // Apartment | Villa
            $table->string('city', 100)->default('Madina');
            $table->unsignedInteger('distance_meters')->default(0); // from Masjid an-Nabawi
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedTinyInteger('bedrooms')->default(0);
            $table->unsignedSmallInteger('min_guests')->default(1);
            $table->unsignedSmallInteger('max_guests')->default(1);
            // Mandatory included (locked ON): dedicated_maid, driver, chauffeur
            $table->boolean('dedicated_maid_included')->default(true);
            $table->boolean('driver_included')->default(true);
            $table->boolean('chauffeur_included')->default(true);
            $table->decimal('price_per_night', 12, 2);
            $table->boolean('is_active')->default(true);
            $table->foreignId('chauffeur_service_id')->nullable()->constrained('chauffeur_services')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
