<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('father_name');
            $table->bigInteger('phone_no');
            $table->string('dob');
            $table->string('gender');
            $table->string('marital_status');
            $table->integer('gotra');
            $table->string('native_place');
            $table->string('preferred_location');
            $table->integer('pincode');
            $table->string('state');
            $table->string('city');
            $table->string('post_office');
            $table->string('address');
            $table->integer('off_pincode');
            $table->string('off_state');
            $table->string('off_city');
            $table->string('off_post_office');
            $table->string('off_address');

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
        Schema::dropIfExists('user_profiles');
    }
}
