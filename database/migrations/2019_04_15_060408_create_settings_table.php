<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('value')->nullable();
            $table->integer('status');
            $table->timestamps();
        });

        $settings = [

            ['id' => 1, 'name' => 'site_logo', 'status' => '1'],
            ['id' => 2, 'name' => 'site_sticky_logo', 'status' => '1'],
            ['id' => 3, 'name' => 'footer_logo', 'status' => '1'],
            ['id' => 4, 'name' => 'footer_desc', 'status' => '1'],
            ['id' => 5, 'name' => 'footer_contact', 'status' => '1'],
            ['id' => 6, 'name' => 'footer_email', 'status' => '1'],
            ['id' => 7, 'name' => 'footer_trademark', 'status' => '1']
            
        ];

        DB::table('setting')->insert($settings);




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
