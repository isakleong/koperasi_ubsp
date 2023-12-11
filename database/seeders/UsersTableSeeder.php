<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 3000) as $index) {
            $memberId = $faker->unique()->randomNumber($nbDigits = 8, $strict = true);
            $email = $faker->unique()->randomNumber($nbDigits = 8, $strict = true);

            DB::table('users')->insert([
                'memberId' => $memberId,
                'email' => $email,
                'password' => Hash::make('password'), // You might want to generate a secure password
                'mothername' => $faker->sentence,
                'fname' => $faker->name,
                'lname' => $faker->name,
                'birthplace' => $faker->sentence,
                'birthdate' => $faker->dateTime,
                'address' => $faker->address,
                'workAddress' => $faker->address,
                'phone' => $faker->phoneNumber,
                'ktp' => $faker->sentence,
                'kk' => $faker->sentence,
                'status' => 1,
                // Add other columns as needed
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}