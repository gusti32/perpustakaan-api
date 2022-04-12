<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(1,3)),
            'writer' => $this->faker->name(),
            'publisher' => $this->faker->streetName(),
            'publication_year' => $this->faker->year(),
            'category_id' => rand(1, 10)
        ];
    }
}
