<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@demo.com',
            'password' => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'demo@demo.com',
            'password' => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        User::factory(20)->create();

        $quant = User::where('id', '>', 1)->count();

        for($i = 0; $i < $quant; $i++){
            Address::factory()->create();
        }
    }
}
