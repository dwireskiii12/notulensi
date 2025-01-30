<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MeetingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Meeting::factory()->count(100)->create();
    }
}
