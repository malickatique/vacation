<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_type',100);
            $table->string('password');
            $table->integer('status')->default(2);
            $table->string('user_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // $users = [
        //     ['id' => 1, 'name' => 'test user', 'email' => 'user@test.com',
        //      'user_type' => 'owner', 
        //      'password' => '$2y$10$.QNmjTb/pp0Uow/Jl.stg.FUvxqzXy0yzs90mOIBvtRD7j9f/AFrS'],

        //      ['id' => 2, 'name' => 'malik', 'email' => 'malik@test.com',
        //       'user_type' => 'owner', 
        //       'password' => '$2y$10$.QNmjTb/pp0Uow/Jl.stg.FUvxqzXy0yzs90mOIBvtRD7j9f/AFrS'],

        //       ['id' => 3, 'name' => 'ateeq', 'email' => 'ateeq@test.com',
        //        'user_type' => 'owner', 
        //        'password' => '$2y$10$.QNmjTb/pp0Uow/Jl.stg.FUvxqzXy0yzs90mOIBvtRD7j9f/AFrS'],

        //        ['id' => 4, 'name' => 'Ali', 'email' => 'ali@test.com',
        //         'user_type' => 'owner', 
        //         'password' => '$2y$10$.QNmjTb/pp0Uow/Jl.stg.FUvxqzXy0yzs90mOIBvtRD7j9f/AFrS'],
        // ];
        // DB::table('users')->insert($users);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
