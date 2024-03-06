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
            [
                'name' => 'Inventory Member',
                'email' => 'inven@gmail.com',
                'designation' => 'Inventory Member',
                'employeeId'=>'0001',
                'contNo' => '0000000001',
                'section_id' => 3,
                'user_level' => 2,
                'password' => Hash::make('erererer'),
            ],
            [
                'name' => 'Assistant Director',
                'email' => 'assd@gmail.com',
                'designation' => 'Assistant Director',
                'employeeId'=>'0003',
                'contNo' => '0000000003',
                'section_id' => 2,
                'user_level' => 3,
                'password' => Hash::make('erererer'),
            ],
            [
                'name' => 'Technichian',
                'email' => 'tech@gmail.com',
                'designation' => 'Technichian',
                'employeeId'=>'0004',
                'contNo' => '0000000004',
                'section_id' => 3,
                'user_level' => 4,
                'password' => Hash::make('erererer'),
            ],
            [
                'name' => 'Assistant IT Officer',
                'email' => 'assItOf@gmail.com',
                'designation' => 'Assistant IT Officer',
                'employeeId'=>'0005',
                'contNo' => '0000000005',
                'section_id' => 3,
                'user_level' => 5,
                'password' => Hash::make('erererer'),
            ],
            [
                'name' => 'Director- IT',
                'email' => 'dit@gmail.com',
                'designation' => 'Director- IT',
                'employeeId'=>'0006',
                'contNo' => '0000000006',
                'section_id' => 3,
                'user_level' => 6,
                'password' => Hash::make('erererer'),
            ],
            [
                'name' => 'Test User',
                'email' => 'testUser@gmail.com',
                'designation' => 'Test User',
                'employeeId'=>'0007',
                'contNo' => '0000000007',
                'section_id' => 3,
                'user_level' => 7,
                'password' => Hash::make('erererer'),
            ]
        ];

        foreach ($array as $value) {

            $existingCategory = User::where('name', $value)->first();

            if (!$existingCategory) {
                User::create($value);
            }
        }
    }
}
