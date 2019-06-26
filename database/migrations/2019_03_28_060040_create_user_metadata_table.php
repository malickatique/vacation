<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_metadata', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name',100);
            $table->string('surname',100);
            $table->string('city',100);
            $table->string('state',100);
            $table->string('zip',100);
            $table->text('address');
            $table->string('number',100);
            $table->text('driving_license');
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
