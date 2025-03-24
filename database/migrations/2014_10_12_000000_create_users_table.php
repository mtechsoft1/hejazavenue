<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();            
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('company_name')->nullable();
            $table->string('email', 60)->nullable();
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('verification_code')->nullable();
            $table->string('phone', 60)->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('profile_image')->default('profile_images/default.png'); 
            $table->string('address')->nullable();
            $table->string('license_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_title')->nullable();
            $table->string('company_description')->nullable();
            $table->string('password')->nullable();                       
            $table->string('token')->nullable();    
            $table->enum('type', USER_TYPES)->default(1);
            $table->string('user_role')->default('user');
            $table->string('is_approved_by_admin')->default('true');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
