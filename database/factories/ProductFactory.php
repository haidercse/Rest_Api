<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
    
                'name' => $this->faker->name(),
                'slug' => Str::slug($this->faker->name()),
                'description' => $this->faker->sentence(),
                'price' => rand(1,4),
            
        ];
    }
}
