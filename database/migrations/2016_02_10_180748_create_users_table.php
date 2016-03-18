<?php

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
            $table->string('name',128);
            $table->string('email',64);
            $table->string('password',64);
            $table->string('social_id',32);
            $table->string('avatar',128);
            $table->string('remember_token',128);
            $table->string('social_token',128);
            $table->integer('osk_id')->unsigned()->index();
            $table->string('is_admin', 1);
            $table->boolean('confirmed')->default('false');
            $table->string('confirm_code', 32);
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
        Schema::drop('users');
    }
}
