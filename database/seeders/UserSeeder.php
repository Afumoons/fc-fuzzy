<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $value = [
            'name' => 'Afu Sidhi',
            'email' => 'afusidhipamekas@gmail.com',
            'password' => Hash::make('admin'),
        ];

        User::create($value);
        User::factory()->count(10)->create();
    }
}
