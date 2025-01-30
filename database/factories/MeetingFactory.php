<?php

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Meeting::class;
    public function definition(): array
    {
        return [

                'auth_id' => $this->faker->numberBetween(1, 4), // Contoh: acak antara id 1-10
                'meeting_theme' => $this->faker->sentence(),
                'meeting_minutes' => $this->faker->numberBetween(1, 4),
                'meeting_leader' => $this->faker->numberBetween(1, 4),
                'description' => $this->faker->paragraph(),
                'start_time' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
                'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
                'participant_count' => $this->faker->numberBetween(5, 20),
                'room_id' => $this->faker->numberBetween(1, 5), // Contoh: acak antara id 1-5
                'status' => $this->faker->randomElement(['Menunggu Pengajuan', 'Menunggu Dimulai', 'Sedang Dimulai', 'Selesai']),

            //
        ];
    }
}
