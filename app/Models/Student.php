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
        'location_id',
        'phone_number',
        'preffered_time',
        'recommendation',
        'batch_id'
    ];
    public function batches(){
        return $this->belongsToMany(Batch::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
    
}
