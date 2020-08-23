<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiledDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chiled_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('family_informations_id');
            $table->integer('child');
            $table->string('prefix',10);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('dob');
            $table->longText('area_of_interest');
            $table->longText('achievement');
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
        Schema::dropIfExists('chiled_details');
    }
}
