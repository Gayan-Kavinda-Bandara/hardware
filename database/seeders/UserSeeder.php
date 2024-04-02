<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array=[
            [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'designation' => 'admin',
            'employeeId'=>'0000',
            'contNo' => '0000000000',
            'section_id' => 3,
            'user_level' => 1,
            'password' => Hash::make('password'),
            ],
        ];

        foreach ($array as $value) {

            $existingCategory = User::where('name', $value)->first();

            if (!$existingCategory) {
                User::create($value);
            }
        }
    }
}
