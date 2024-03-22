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
            'Starting_date'=>$this->faker->date(),
            'Ending_date'=>$this->faker->date(),
            'place'=>$this->faker->randomElement(["Megenagna",'Piyasa']),
            'time'=>$this->faker->randomElement(['Morning 3:00-4:30','Afternoon 8:00-9:30'])
        ];
    }
}
