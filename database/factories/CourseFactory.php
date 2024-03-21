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
            'name'=>$this->faker->randomElement(['laravel','backend','flutter','react']),
            'co-ordinator'=>$this->faker->name,
            'place'=>"megenagna",
            'time'=>$this->faker->randomElement(['morning 3:00-4:30','afternoon 8:00-9:30'])
        ];
    }
}
