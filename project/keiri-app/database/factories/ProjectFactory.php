<?php

namespace Database\Factories;

use App\Enums\ProjectPriority;
use App\Enums\ProjectStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeThisYear();
        $endDate = (clone $startDate)->modify('+' . rand(60, 90) . ' days');

        return [
            'project_code' =>  fake()->unique()->bothify('PRJ-###??'),
            'project_name' => fake()->words(3, true),
            'project_start_date' => $startDate->format('Y-m-d'),
            'project_end_date' => $endDate->format('Y-m-d'),
            'phase' => fake()->randomElement([1, 2, 3]),
            'priority' => fake()->randomElement([ProjectPriority::HIGH, ProjectPriority::MEDIUM, ProjectPriority::LOW]),
            'status' => fake()->randomElement([ProjectStatus::NOT_STARTED, ProjectStatus::IN_PROGRESS, ProjectStatus::COMPLETED]),
            'note' => fake()->sentence(),
        ];
    }
}
