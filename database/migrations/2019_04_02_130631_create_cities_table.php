<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('state_id');
            $table->timestamps();
        });
        $cities = [
            ['id' => 1, 'name' => 'Rawalpindi', 'state_id' => 1],
            ['id' => 2, 'name' => 'Islamabad', 'state_id' => 1],
            ['id' => 3, 'name' => 'Lahore', 'state_id' => 1],

            ['id' => 4, 'name' => 'Karachi', 'state_id' => 2],
            ['id' => 5, 'name' => 'Nawab Shah', 'state_id' => 2],
            ['id' => 6, 'name' => 'Gawadar', 'state_id' => 2],
            
            ['id' => 7, 'name' => 'Peshawar', 'state_id' => 3],
            ['id' => 8, 'name' => 'Mardan', 'state_id' => 3],
            ['id' => 9, 'name' => 'Kurram Agency', 'state_id' => 3],
            
        ];
        DB::table('cities')->insert($cities);
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
