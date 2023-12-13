<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array=[
            ['section_name' => 'Office Section'],
            ['section_name' => '1920 Help Center Section'],
            ['section_name' => 'IT Section']
        ];

        foreach ($array as $value) {

            $existingCategory = Section::where('section_name', $value)->first();

            if (!$existingCategory) {
                Section::create($value);
            }
        }
    }
}
