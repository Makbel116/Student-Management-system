<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->unique()->randomElement(['Laravel','Backend','Flutter','React']),
            'description'=>$this->faker->sentence(6)
        ];
    }
}
