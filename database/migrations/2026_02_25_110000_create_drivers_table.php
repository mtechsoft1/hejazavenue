<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('nationality', 100)->nullable();
            $table->string('image')->nullable();
            $table->string('license_number', 100)->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->unsignedSmallInteger('experience_years')->default(0);
            $table->json('languages')->nullable(); // e.g. ["arabic","english","urdu"]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
