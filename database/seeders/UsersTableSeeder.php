<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //     $faker = Faker::create('user_id'); // Menggunakan bahasa Indonesia untuk Faker

    //     foreach (range(1, 10) as $index) { // Mengisi 10 data pengguna, sesuaikan dengan kebutuhan Anda
    //         DB::table('users')->insert([
    //             'name' => $faker->name,
    //             'email' => $faker->unique()->safeEmail,
    //             'password' => Hash::make('password'), // Menggunakan password default 'password', Anda mungkin ingin mengubah ini
    //             'role_id' => $faker->numberBetween(1, 3), // Contoh role_id yang di-generate secara acak antara 1 dan 3
    //             'position' => $faker->jobTitle,
    //             'phone_number' => $faker->phoneNumber,
    //             'faculty' => $faker->word, // Contoh faculty di-generate secara acak
    //             'study_program' => $faker->sentence(2), // Contoh study_program di-generate secara acak
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    // }

    $name = [

        'RESKI'

    ];

    $email = [
                'dwireski@gmail.com'
    ];
    $position = [
        'DOSEN'
    ];
    $password = Hash::make('sirapat123');

     // Buat pengguna dengan role admin
     User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin1234'),
        'role' => 1, // Admin
        'image' => 'meyoong.png',
    ]);



    $count = count($name);

    for ($i = 0; $i < $count; $i++) {
        DB::table('users')->insert([
            'name' => $name[$i],
            'email' => $email[$i],
            'position' => $position[$i],
            'password' => $password,
            'role' => 4,
            'image' => 'meyoong.png',
        ]);
    }

    // Buat pengguna dengan role sekretaris
    // User::create([
    //     'name' => 'Sekretaris User',
    //     'email' => 'sekretaris@example.com',
    //     'password' => Hash::make('sekretaris1234'),
    //     'role' => 2, // Sekretaris
    // ]);

    // Buat pengguna dengan role notulensi
    // User::create([
    //     'name' => 'Notulensi User',
    //     'email' => 'notulensi_user@example.com',
    //     'password' => Hash::make('notulensi1234'),
    //     'role' => 3, // Notulensi
    // ]);

    // // Buat pengguna dengan role user
    // User::create([
    //     'name' => 'General User',
    //     'email' => 'user@example.com',
    //     'password' => Hash::make('user1234'),
    //     'role' => 4, // User
    // ]);

    }
}
