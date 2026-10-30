<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Membuat akun dummy: 1 akun admin tetap + 5 akun acak dari Faker.
     * Semua akun memakai password "password123" (disimpan dalam bentuk hash bcrypt).
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Akun tetap supaya mudah dipakai saat demo/login
        User::updateOrCreate(
            ['email' => 'admin@kbbgo.test'],
            [
                'name'              => 'Admin KBB GO',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
            ]
        );

        // 5 akun dummy dari Faker
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name'              => $faker->name(),
                'email'             => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
            ]);
        }
    }
}
