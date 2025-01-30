<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('room_id'); // Menggunakan bahasa Indonesia untuk Faker

        foreach (range(1, 10) as $index) { // Mengisi 10 data ruangan, sesuaikan dengan kebutuhan Anda
            DB::table('rooms')->insert([
                'room_name' => $faker->sentence(2),
                'capacity' => $faker->numberBetween(10, 100), // Kapasitas di-generate secara acak antara 10 dan 100
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
