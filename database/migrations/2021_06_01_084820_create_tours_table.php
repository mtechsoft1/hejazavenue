<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
            $table->string('trip_image')->default('tour_images/default.jpg');
            $table->string('trip_name')->nullable();
            $table->text('trip_description')->nullable();
            $table->timestamp('trip_start_date')->nullable();
            $table->timestamp('trip_end_date')->nullable();
            $table->string('trip_total_days')->nullable();
            $table->string('kids_under_3_years')->nullable();
            $table->string('kids_between_3_to_8_years')->nullable();
            $table->string('kids_above_8_years')->nullable();
            $table->text('attractions')->nullable();
            $table->string('trip_duration')->nullable();
            $table->string('status')->default('active');                   
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
        Schema::dropIfExists('tours');
    }
}
