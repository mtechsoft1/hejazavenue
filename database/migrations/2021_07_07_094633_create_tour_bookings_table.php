<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('email')->default('');
            $table->string('phone')->default('');
            $table->string('country')->default('');
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade'); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('pickup_point_id')->nullable(); //should be foreign key            
            $table->string('package_type')->nullable();
            $table->string('adults_in_number')->nullable();
            $table->string('kids_under_3_years')->nullable();
            $table->string('kids_between_3_to_8')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('account_no')->nullable();
            $table->string('payment_type')->nullable(); //partial 20% or full payment
            $table->string('paid')->default('');
            $table->string('remaining')->default('');
            $table->string('payment_date')->nullable();
            $table->string('deposit_receipt')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('tour_bookings');
    }
}
