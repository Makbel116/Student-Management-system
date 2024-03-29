<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
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
            'name' =>$this->faker->unique()->randomElement(['Addis Ketema','Akaky Kaliti','Arada','Bole','Gullele','Kirkos','Kolfe Keraniyo','Lemi Kura','Lideta','Nifas Silk-Lafto','Yeka']),

        ];
    }
}
