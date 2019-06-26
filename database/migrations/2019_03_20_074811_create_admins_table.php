<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('job_title');
            $table->integer('status')->default(1);
            $table->string('imageurl')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $admins = [
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@test.com', 'job_title' => 'super-admin', 'password' => '$2y$10$.QNmjTb/pp0Uow/Jl.stg.FUvxqzXy0yzs90mOIBvtRD7j9f/AFrS']
        ];

        DB::table('admins')->insert($admins);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('admins');
    }
}
