<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sCategories' => $this->faker->word,
            'sDes' => $this->faker->sentence,
            'iStatus' => '1',
        ];
    }
}
