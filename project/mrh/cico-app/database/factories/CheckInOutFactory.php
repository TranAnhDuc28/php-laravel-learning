<?php

namespace Database\Factories;

use App\Models\CheckInOut;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckInOut>
 */
class CheckInOutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkInTime = $this->faker->dateTimeBetween('08:00:00', '10:00:00');
        $checkOutTime = $this->faker->dateTimeBetween('17:00:00', '19:00:00');

        $inLackTime = max(0, (new Carbon('09:00:00'))->diffInMinutes($checkInTime, false));
        $outLackTime = max(0, (new Carbon('18:00:00'))->diffInMinutes($checkOutTime, false));

        return [
//            'user_id' => $this->faker->numberBetween(1, 100),
            'user_id' => 1,
            'date' => $this->faker->date(),
//            'check_in' => $checkInTime->format('H:i:s'),
//            'check_out' => $checkOutTime->format('H:i:s'),
//            'role' => 1,
            'check_in' => '08:00:00',
            'check_out' => '17:00:00',
            'in_lack_time' => 5,
            'out_lack_time' => 10,
            'over_time' => '',
//            'over_time' => $this->faker->numberBetween(0, 120),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
