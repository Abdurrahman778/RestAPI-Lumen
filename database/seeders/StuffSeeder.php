<?php

namespace Database\Seeders;

use Database\Factories\StuffFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stuff;

class StuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stuff::factory()->count(5)->create();
    }
}
