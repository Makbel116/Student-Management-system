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
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['M', 'F']);
            $table->foreignId('location_id')->nullable();
            $table->string('phone_number');
            $table->string('email')->nullable()->unique();
            $table->enum('status',['Fresh','Junior','Senior']);
            $table->enum('preffered_time',['Morning','Afternoon']);
            $table->string('recommendation')->nullable();
            $table->integer('remaining_payment')->nullable();
            $table->string('drop_out')->nullable();
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
