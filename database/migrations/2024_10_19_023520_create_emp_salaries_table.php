<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpSalariesTable extends Migration
{
    public function up()
    {
        Schema::create('emp_salaries', function (Blueprint $table) {
            $table->integer('id')->length(10)->autoIncrement();
            $table->integer('employee_id');
            $table->integer('month');
            $table->integer('year');
            $table->double('basic_salary');
            $table->double('bonus');
            $table->double('bpjs');
            $table->double('jp');
            $table->double('loan');
            $table->double('total_salary');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_salaries');
    }
}
