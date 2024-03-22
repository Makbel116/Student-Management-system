<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'teacher_id',
        'place',
        'time',
        'Starting_date',
        'Ending_date'
    ];

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

}
