<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Create admin user
        User::insert([
            'name'      => 'Foundation',
            'last_name' => 'Admin',
            'email'     => 'admin@foundation.com',
            'password'  => '$2y$12$RRNRvgEu6otXgxIDUt8IGeM6yCEaNub/0UZPGBDxmoUn8HO3sC04C', // hashed password
            'is_admin'  => true,
        ]);

        // Create 100 random users
        for ($i = 0; $i < 99; $i++) {
            User::insert([
                'name'      => $faker->name(),
                'last_name' => $faker->lastName(),
                'email'     => $faker->unique()->safeEmail(),
                'password'  => '$2y$12$RRNRvgEu6otXgxIDUt8IGeM6yCEaNub/0UZPGBDxmoUn8HO3sC04C',
            ]);
        }
    }
}
