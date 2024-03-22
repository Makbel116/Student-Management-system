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
            'gender'=>$this->faker->randomElement(['M','F']),
            'location' =>$this->faker->randomElement(['Addis Ketema','Akaky Kaliti','Arada','Bole','Gullele','Kirkos','Kolfe Keraniyo','Lemi Kura','Lideta','Nifas Silk-Lafto','Yeka']),
            'phone_number'=>'0943031703',
            'email'=>$this->faker->email,
            'status'=>$this->faker->randomElement(['Junior','Senior']),
            'preffered_time'=>$this->faker->randomElement(['Morning','Afternoon']),
            
        ];
    }
}
