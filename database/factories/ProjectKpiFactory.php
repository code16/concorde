<?php

namespace Database\Factories;

use App\Models\ProjectTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectKpi>
 */
class ProjectKpiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->numerify(),
            'content' => fake()->sentence(),
            'suffix' =>fake()->randomElement(['k', ' k+', '+', '']),
        ];
    }
}
