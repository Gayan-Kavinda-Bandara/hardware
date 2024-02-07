<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array=[
            ['state_name' => 'active'],
            ['state_name' => 'relesed'],
        ];

        foreach ($array as $value) {

            $existingCategory = State::where('state_name', $value)->first();

            if (!$existingCategory) {
                State::create($value);
            }
        }
    }
}
