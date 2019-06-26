<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('value',100);
            $table->timestamps();
        });
        $configuration =[
            [
                'name' => "name",
                'value' => "OVR",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "description",
                'value' => "Propert Rental",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "logo",
                'value' => "",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "favicon",
                'value' => "",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "contact_us_email",
                'value' => "info@ovr.com",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "phone",
                'value' => "111128128",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "currency",
                'value' => "Dollar",
                'created_at' => date("Y-m-d H:i:s")
            ]
        ];
        
        DB::table('configurations')->insert($configuration);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
