<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('subscription_feature', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscription_id');
            $table->string('feature_name');
            $table->timestamps();
        });

        $subscription_feature = [
            ['id' => 1, 'subscription_id' => 1, 'feature_name' => 'Feature name'],
            ['id' => 2, 'subscription_id' => 1, 'feature_name' => 'Feature name2'],
            ['id' => 3, 'subscription_id' => 2, 'feature_name' => 'Feature name'],
            ['id' => 4, 'subscription_id' => 2, 'feature_name' => 'Feature name2'],
        ];

        DB::table('subscription_feature')->insert($subscription_feature);
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
