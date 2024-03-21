<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $teachers=Teacher::factory(6)->create();
        $courses=Course::factory(6)->create();
        for ($i=0; $i <6 ; $i++) { 
            # code...
            Student::factory(2)->create([
                'teacher_id'=>$teachers[$i]->id,
                'course_id'=>$courses[$i]->id
            ]);
        }
        
    }
}
