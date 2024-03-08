<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserLevel;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array=[
            ['user_level_name' => 'level 1 Admin'],
            ['user_level_name' => 'level 2 Inventory Member'],
            ['user_level_name' => 'level 3 Assistant Director'],
            ['user_level_name' => 'level 4 Technichian'],
            ['user_level_name' => 'level 5 Assistant IT Officer '],
            ['user_level_name' => 'level 6 User'],
        ];

        foreach ($array as $value) {

            $existingCategory = UserLevel::where('user_level_name', $value)->first();

            if (!$existingCategory) {
                UserLevel::create($value);
            }
        }
    }
}
