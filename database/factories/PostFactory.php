<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'content' => $this->faker->realText(300),
            'user_id' => 1, //Admin user with id=1
        ];
    }
}
