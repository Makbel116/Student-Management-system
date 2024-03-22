<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            //images if needed
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['M', 'F']);
            $table->string('location');
            $table->string('phone_number',10);
            $table->string('email')->nullable();
            $table->enum('status',['Fresh','Junior','Senior']);
            $table->enum('preffered_time',['Morning','Afternoon']);
            $table->string('recommendation')->nullable();
            $table->foreignId('course_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
