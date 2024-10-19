<?php

namespace Database\Seeders;

use App\Models\EmpSalary;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmpSalarySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $employees = Employee::all();

        foreach ($employees as $employee) {
            EmpSalary::create([
                'employee_id' => $employee->id,
                'month' => $faker->month,
                'year' => $faker->year,
                'basic_salary' => $faker->randomFloat(2, 3000000, 5000000),
                'bonus' => $faker->randomFloat(2, 100000, 500000),
                'bpjs' => $faker->randomFloat(2, 100000, 500000),
                'jp' => $faker->randomFloat(2, 50000, 200000),
                'loan' => $faker->randomFloat(2, 0, 1000000),
                'total_salary' => $faker->randomFloat(2, 3500000, 8000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

