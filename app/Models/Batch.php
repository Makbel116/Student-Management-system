<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('end_date', 'like', '%' . request('search') . '%')
                ->orWhere('start_date', 'like', '%' . request('search') . '%');
        }
    }
    protected $fillable = [
        'name',
        'place_id',
        'schedule_id',
        'start_date',
        'end_date',
        'teacher_id',
        'course_id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
