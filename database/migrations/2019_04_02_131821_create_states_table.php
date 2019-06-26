<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('country_id');
            $table->timestamps();
        });

        $states = [
            ['id' => 1, 'name' => 'Punjab', 'country_id' => 1],
            ['id' => 2, 'name' => 'Sindh', 'country_id' => 1],
            ['id' => 3, 'name' => 'KPK', 'country_id' => 1],
        ];

        DB::table('states')->insert($states);
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
