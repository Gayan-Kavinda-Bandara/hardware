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
            'password' => Hash::make('password')
            ],
            [
                'name' => 'Ruwan Bandara',
                'email' => 'ruwan@gmail.com',
                'designation' => 'Inventory Member',
                'employeeId'=>'0001',
                'contNo' => '0000000001',
                'section_id' => 1,
                'user_level' => 2,
                'password' => Hash::make('password')
            ],
            [
                    'name' => 'Pawan Bandara',
                    'email' => 'pawan@gmail.com',
                    'designation' => 'Assistant Director',
                    'employeeId'=>'0002',
                    'contNo' => '0000000002',
                    'section_id' => 2,
                    'user_level' => 3,
                    'password' => Hash::make('password')
            ],
            [
                'name' => 'Ramesh Bandara',
                'email' => 'ramesh@gmail.com',
                'designation' => 'Technichian',
                'employeeId'=>'0003',
                'contNo' => '0000000003',
                'section_id' => 3,
                'user_level' => 3,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Heshan Bandara',
                'email' => 'heshan@gmail.com',
                'designation' => 'IT Officer',
                'employeeId'=>'0004',
                'contNo' => '0000000004',
                'section_id' => 3,
                'user_level' => 5,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Kamal Bandara',
                'email' => 'kamal@gmail.com',
                'designation' => 'IT Director',
                'employeeId'=>'0005',
                'contNo' => '0000000005',
                'section_id' => 3,
                'user_level' => 6,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Gayan Bandara',
                'email' => 'gayan@gmail.com',
                'designation' => 'user',
                'employeeId'=>'0006',
                'contNo' => '0000000006',
                'section_id' => 2,
                'user_level' => 7,
                'password' => Hash::make('password')
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
