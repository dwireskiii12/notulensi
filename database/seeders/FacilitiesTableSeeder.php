<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fasilitasRapat = [
            'Proyektor LCD',
            'Papan Tulis',
            'Flipchart',
            'Microphone',
            'Sound System',
            'Perangkat Video Conference',
            'Telepon Konferensi',
            'Podium',
            'Laser Pointer',
            'Kursi Nyaman',
            'Meja',
            'Layanan Katering',
            'Wi-Fi',
            'AC',
            'Sistem Pemesanan Ruang Rapat',
            'Fasilitas Parkir',
        ];

        $faker = Faker::create('id_ID'); // Menggunakan bahasa Indonesia untuk Faker

        foreach (range(1, 10) as $index) { // Mengisi 10 data fasilitas, sesuaikan dengan kebutuhan Anda
            DB::table('facilities')->insert([
                'facilities' => $faker->word, // Nama fasilitas di-generate secara acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
