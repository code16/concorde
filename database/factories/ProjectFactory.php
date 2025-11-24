<?php

namespace Database\Factories;

use App\Models\ProjectTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fn ($attributes) => str($attributes['title'])->slug(),
        ];
    }
}
