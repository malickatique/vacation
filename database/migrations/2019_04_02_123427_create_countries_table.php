<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sortname');
            $table->string('name');
            $table->integer('phonecode');
            $table->timestamps();
        });

        $countries = [
            ['id' => 1, 'sortname' => 'Pak', 'name' => 'Pakistan',
             'phonecode' => 92],
             ['id' => 2, 'sortname' => 'Ind', 'name' => 'India',
              'phonecode' => 91],
        ];

        DB::table('countries')->insert($countries);
        
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
