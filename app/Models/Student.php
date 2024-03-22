<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age',
        'gender',
        'status',
        'location',
        'phone_number',
        'preffered_time',
        'recommendation',
        'course_id'
    ];
    public function course(){
        return $this->belongsTo(Course::class);
    }
    
}
