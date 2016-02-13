<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 128);
            $table->string('email', 64);
            $table->string('slug', 64);
            $table->text('description', 64);
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
        Schema::drop('osks');
    }
}
