<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
        'time',
        'start_date',
        'end_date',
        'teacher_id',
        'course_id'
    ];

    public function students(){
        return $this->belongsToMany(Student::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
