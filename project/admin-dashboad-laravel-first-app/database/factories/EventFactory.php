<?php

namespace Database\Factories;

use App\Enums\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1),
            'type' => EventType::INFO,
            'title' => $this->faker->sentence,
            'start' => Carbon::createFromDate(now()->year, $this->faker->month, $this->faker->dayOfMonth)->startOfDay()->toDateTimeString(),
            'end' => null,
            'all_day' => true,
            'department' => $this->faker->word,
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'url' => $this->faker->url,
        ];
    }
}
