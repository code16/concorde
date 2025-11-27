<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fn ($attributes) => str($attributes['title'])->slug(),
            'category_label' => fake()->word(),
            'publication_date' => fake()->date(),
        ];
    }
}
