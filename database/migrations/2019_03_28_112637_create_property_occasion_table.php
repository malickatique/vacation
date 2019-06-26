<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyOccasionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('property_occasion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->string('occasion_name')->nullable();
            $table->string('availability_from')->nullable();
            $table->string('availability_to')->nullable();
            $table->integer('per_night_rent')->nullable();
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
        //
    }
}
