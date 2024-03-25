<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
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
            'name'=>'Batch '.$this->faker->numberBetween(0,99),
            'start_date'=>$this->faker->date(),
            'end_date'=>$this->faker->date(),
            'place'=>$this->faker->randomElement(["Megenagna",'Piyasa']),
            'time'=>$this->faker->randomElement(['Morning 3:00-4:30','Afternoon 8:00-9:30'])
        ];
    }
}
