<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
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
            'status'=>$this->faker->randomElement(['junior','senior']),
            'gender'=>$this->faker->randomElement(['M','F']),
            'address' =>$this->faker->address,
            'phone_number'=>'0943031703',
            'email'=>$this->faker->email,
            'status'=>$this->faker->randomElement(['junior','senior']),
            'preffered_time'=>$this->faker->randomElement(['morning 3:00-4:30','afternoon 8:00-9:30']),
        ];
    }
}
