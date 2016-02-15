<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours', function (Blueprint $table) {
            //$table->increments('id')->unsigned();
            $table->date('drive_date')->primary();
            $table->tinyInteger('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students');
            $table->decimal('count', 2, 1);
            $table->tinyInteger('instructor_id')->unsigned()->index();
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
        Schema::drop('hours');
    }
}
