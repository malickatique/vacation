<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->timestamps();
        });

        $features = [
            ['id' => 1, 'name' => 'Center Cooling'],
            ['id' => 2, 'name' => 'Balcony'],
            ['id' => 3, 'name' => 'Pet Friendly'],
            ['id' => 4, 'name' => 'Barbeque'],
            ['id' => 5, 'name' => 'Fire Alarm'],
            ['id' => 6, 'name' => 'Modern Kitchen'],
            ['id' => 7, 'name' => 'Storage'],
            ['id' => 8, 'name' => 'Dryer'],
            ['id' => 9, 'name' => 'Heating'],
            ['id' => 10, 'name' => 'Pool'],
            ['id' => 11, 'name' => 'Laundry'],
            ['id' => 12, 'name' => 'Sauna'],
            ['id' => 13, 'name' => 'Gym'],
            ['id' => 14, 'name' => 'Elevator'],
            ['id' => 15, 'name' => 'Dish Washer'],
            ['id' => 16, 'name' => 'Emergency Exit']
        ];

        DB::table('features')->insert($features);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
