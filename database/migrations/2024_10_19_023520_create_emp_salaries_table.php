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
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->double('basic_salary')->nullable();
            $table->double('bonus')->nullable();
            $table->double('bpjs')->nullable();
            $table->double('jp')->nullable();
            $table->double('loan')->nullable();
            $table->double('total_salary')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_salaries');
    }
}
