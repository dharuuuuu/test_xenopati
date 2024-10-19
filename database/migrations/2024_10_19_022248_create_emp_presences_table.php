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
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->integer('late_in')->nullable();
            $table->integer('early_out')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_presences');
    }
}

