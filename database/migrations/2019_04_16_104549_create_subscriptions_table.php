<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //subscription
        Schema::create('subscription', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('detail');
            $table->integer('price')->nullable();
            $table->integer('status');
            $table->timestamps();
        });

        $subscription = [
            ['id' => 1, 'name' => 'Sub. name', 'detail' => 'details',
             'price' => 786, 'status' => 1],
             ['id' => 2, 'name' => 'Sub. name2', 'detail' => 'details2',
              'price' => 786, 'status' => 1],
        ];

        DB::table('subscription')->insert($subscription);
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
