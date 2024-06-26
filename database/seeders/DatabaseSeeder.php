<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            SectionSeeder::class
        );

        $this->call(
            UserLevelSeeder::class
        );

        $this->call(
            UserSeeder::class
        );

        $this->call(
            StateSeeder::class
        );

        $this->call(
            DeviceCheckSeeder::class
        );
    }
}
