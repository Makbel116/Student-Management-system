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
        \App\Models\User::factory(1)->create();
        $teachers = Teacher::factory(2)->create();
        foreach ($teachers as $teacher) {

            $courses = Course::factory(2)->create([
                'teacher_id' => $teacher->id,

            ]);
            foreach ($courses as $course) {
                Student::factory(6)->create([
                    'course_id' =>$course->id,
                ]);
            }
        }
    }
}
