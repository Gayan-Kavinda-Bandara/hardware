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
            ['user_level_name' => 'level 1'],
            ['user_level_name' => 'level 2'],
            ['user_level_name' => 'level 3']
        ];

        foreach ($array as $value) {

            $existingCategory = UserLevel::where('user_level_name', $value)->first();

            if (!$existingCategory) {
                UserLevel::create($value);
            }
        }
    }
}
