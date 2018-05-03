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
            
            $table->increments('id')->unsigned();
            $table->string('email',50)->unique();
            $table->string('password')->nullable();
            $table->string('access_token')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->double('lat')->default(0);
            $table->double('long')->default(0);
            $table->double('rating')->default(0);
            $table->string('device')->nullable();
            $table->string('gcm_token')->nullable();
            $table->string('notification')->default(true);
            $table->string('social_login')->nullable();
            $table->string('social_id')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
