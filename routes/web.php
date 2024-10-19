<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalaryCalculationController;

Route::get('/', function () {
    return redirect()->route('employees.index');
});

Route::resource('employees', EmployeeController::class);
Route::resource('presences', PresenceController::class);
Route::resource('salaries', SalaryController::class);
Route::resource('salary_calculations', SalaryCalculationController::class);