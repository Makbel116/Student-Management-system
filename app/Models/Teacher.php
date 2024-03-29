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
