<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
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
            'name' =>$this->faker->name,
            'age'=>$this->faker->numberBetween(15,45),
            'gender'=>$this->faker->randomElement(['male','female']),
            'address' =>$this->faker->address,
            'phone_number'=>$this->faker->numberBetween(900000000,9999999999),
            'email'=>$this->faker->email,
            'status'=>$this->faker->randomElement(['fresh','junior','senior']),
            'preffered_time'=>$this->faker->randomElement(['morning 3:00-4:30','afternoon 8:00-9:30']),
            'recommended_by'=>$this->faker->sentence
        ];
    }
}
