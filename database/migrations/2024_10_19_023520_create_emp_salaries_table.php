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
            $table->double('bonus')->default(0);
            $table->double('bpjs')->default(0);
            $table->double('jp')->default(0);
            $table->double('loan');
            $table->double('total_salary')->default(0);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_salaries');
    }
}
