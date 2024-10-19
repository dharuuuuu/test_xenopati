<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            Employee::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'user_picture' => $faker->imageUrl(200, 200, 'people'),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

