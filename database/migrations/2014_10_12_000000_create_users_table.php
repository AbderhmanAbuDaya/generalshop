<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('shipping_address')->unsigned()->nullable();
            $table->integer('billing_address')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->boolean('email_verified')->default(false);
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->boolean('moblie_verified')->default(false);
            $table->rememberToken();
            $table->timestamps();


        });
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
