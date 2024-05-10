<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Batch;
use App\Models\Place;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Location;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $permissionNames = [
            'create users',
            'read users',
            'update users',
            'delete users',

            'create students',
            'read students',
            'update students',
            'delete students',

            'create teachers',
            'read teachers',
            'update teachers',
            'delete teachers',

            'create courses',
            'read courses',
            'update courses',
            'delete courses',

            'create batches',
            'read batches',
            'update batches',
            'delete batches',

            'create roles',
            'read roles',
            'update roles',
            'delete roles',

            'assign permissions',
            'revoke permissions'
        ];

        $permissions = [];

        foreach ($permissionNames as $permissionName) {
            $permissions[] = Permission::create(['name' => $permissionName]);
        }
        
        $role = Role::create(['name' => 'admin']);
        $role->syncPermissions($permissions);

        $user = User::factory()->create();
        $user->assignRole($role);

        $locations = Location::factory(11)->create();
        $places = Place::factory(4)->create();

        //creates 2 teachers 
        for ($i = 0; $i < 2; $i++) {
            Teacher::factory()->create([
                'location_id' => $locations[$i]->id,

            ]);
        }

        //holds the 2 teachers
        $teachers = Teacher::all();

        //creates 4 courses
        Course::factory(4)->create();

        //holds the 4 courses created
        $courses = Course::all();

        $schedules = Schedule::factory(4)->create();
        //creates 8 batches
        //each courses are assiged with 2 batches assuming each teachers teached 4 batches
        for ($i = 0; $i < 4; $i++) {
            foreach ($teachers as $teacher) {

                Batch::factory()->create([
                    // creates relationship between course & teachers with batch
                    'course_id' => $courses[$i]->id,
                    'teacher_id' => $teacher->id,
                    'schedule_id' => $schedules[$i]->id,
                    'place_id' => $places[$i]->id
                ]);
            }
        }


        //holds all batches created
        $batches = Batch::all();

        //creates 50 students with unassigned batch
        for ($i = 0; $i < 10; $i++) {
            # code...
            Student::factory(5)->create([
                'location_id' => $locations[$i]->id
            ]);
        }

        //holds all student created
        $students = Student::all();


        // Shuffle the students and batches
        $shuffledStudents = $students->shuffle();
        $shuffledBatches = $batches->shuffle();



        // Loop through each of shuffled batch and assign 40 of the shuffled students
        foreach ($batches as $batch) {
            // Take the first five students
            $assignedStudents = $shuffledStudents->take(5);

            // Attach the students to the batch
            $batch->students()->attach($assignedStudents);

            // Remove the assigned shuffled students from the collection
            $shuffledStudents = $shuffledStudents->except($assignedStudents->pluck('id')->toArray());
        }






        // Assign 7 remainig shuffled students to two different random shuffled batches
        $assignedStudents = $shuffledStudents->take(7);
        $assignedBatches = $shuffledBatches->take(2);

        foreach ($assignedBatches as $batch) {
            $batch->students()->attach($assignedStudents->pluck('id')->toArray());

            $shuffledStudents = $shuffledStudents->except($assignedStudents->pluck('id')->toArray());

            $shuffledBatches = $shuffledBatches->except($assignedBatches->pluck('id')->toArray());
        }

        // Assign 3 remainig shuffled students to 3 different random shuffled batches

        $threeStudent = $shuffledStudents->take(3);
        $threeBatches = $shuffledBatches->take(3);

        foreach ($threeBatches as $batch) {
            $batch->students()->attach($threeStudent);
        }
    }
}
