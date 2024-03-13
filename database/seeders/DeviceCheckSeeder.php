<?php

namespace Database\Seeders;

use App\Models\DeviceCheck;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array=[
            ['main_device_name' => 'Desktop'],
            ['main_device_name' => 'Laptop'],
            ['main_device_name' => 'Workstation Computer'],
            ['main_device_name' => 'Printer'],
            ['main_device_name' => 'UPS'],
            ['main_device_name' => 'Other']
        ];

        foreach ($array as $value) {

            $existingCategory = DeviceCheck::where('main_device_name', $value)->first();

            if (!$existingCategory) {
                DeviceCheck::create($value);
            }
        }
    }
}
