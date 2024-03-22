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
            'gender'=>$this->faker->randomElement(['M','F']),
            'location' =>$this->faker->randomElement(['Addis Ketema','Akaky Kaliti','Arada','Bole','Gullele','Kirkos','Kolfe Keraniyo','Lemi Kura','Lideta','Nifas Silk-Lafto','Yeka']),
            'phone_number'=>'0943031703',
            'email'=>$this->faker->email,
            'status'=>$this->faker->randomElement(['Fresh','Junior','Senior']),
            'preffered_time'=>$this->faker->randomElement(['Morning','Afternoon']),
            'recommendation'=>$this->faker->randomElement(['Friends','Online Course Advertisement','Online Reviews and Testimonials','Course Previews or Demos','Online Communities and Social
            Media'])
        ];
    }
}
