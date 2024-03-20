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
        $teacher=Teacher::factory()->create();
        $course=Course::factory()->create([
            'teached_by'=>$teacher->id
        ]);
        Student::factory()->create([
            'course_id'=>$course->id
        ]);
        
    }
}
