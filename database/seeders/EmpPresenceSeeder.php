<?php

namespace Database\Seeders;

use App\Models\EmpPresence;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmpPresenceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $employees = Employee::all();

        foreach ($employees as $employee) {
            EmpPresence::create([
                'employee_id' => $employee->id,
                'check_in' => $faker->dateTimeThisMonth(),
                'check_out' => $faker->dateTimeThisMonth(),
                'late_in' => $faker->numberBetween(-120, 120),
                'early_out' => $faker->numberBetween(-120, 120),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

