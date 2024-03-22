<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
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
    ];

    public function course(){
        return $this->hasMany(Course::class);
    }
}
