<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->unique()->randomElement(['Morning Session(3:00-4:30)','Afternoon Session (8:00-9:30)','VIP session'])
        ];
    }
}
