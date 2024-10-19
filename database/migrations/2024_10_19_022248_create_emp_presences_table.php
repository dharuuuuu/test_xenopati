<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpPresencesTable extends Migration
{
    public function up()
    {
        Schema::create('emp_presences', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('employee_id');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('late_in');
            $table->integer('early_out');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_presences');
    }
}

