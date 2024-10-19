<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id', false, true)->length(10)->autoIncrement();
            $table->string('name', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('user_picture', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

