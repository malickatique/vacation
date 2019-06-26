<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_type',100);
            $table->text('description');
            $table->timestamps();
        });

        $user_types = [
            ['id' => 1, 'user_type' => 'admin', 'description' => 'this is admin'],
            ['id' => 2, 'user_type' => 'owner', 'description' => 'this is owner'],
            ['id' => 3, 'user_type' => 'guest', 'description' => 'this is guest'],
            ['id' => 4, 'renter' => 'renter', 'description' => 'this is renter']
        ];

        DB::table('user_types')->insert($user_types);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
