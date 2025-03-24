<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPickupPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_pickup_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->string('pickup_city')->nullable();
            $table->string('per_seat_fare')->nullable();
            $table->string('per_seat_fare_currency')->nullable();
            $table->string('couple_package_fare')->nullable();
            $table->string('couple_package_fare_currency')->nullable();
            $table->string('family_package_fare')->nullable();
            $table->string('family_package_fare_currency')->nullable(); 
            $table->string('kids_under_3_years')->nullable();
            $table->string('kids_between_3_to_8')->nullable();
            $table->string('kids_above_8_years')->nullable();           
            $table->string('pickup_point')->nullable();
            $table->string('pickup_point_latitude')->nullable();
            $table->string('pickup_point_longitude')->nullable();
            $table->string('pickup_date')->nullable();
            $table->string('pickup_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_pickup_points');
    }
}
