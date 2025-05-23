<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('age', 'like', '%' . request('search') . '%')
                ->orWhere('status', 'like', '%' . request('search') . '%')
                ->orWhere('gender', 'like', '%' . request('search') . '%')
                ->orWhere('phone_number', 'like', '%' . request('search') . '%');

        }
    }
    
    protected $fillable = [
        'name',
        'email',
        'age',
        'gender',
        'status',
        'location_id',
        'phone_number',
        'preffered_time',
    ];

    public function batch(){
        return $this->hasMany(Batch::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
}
