<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
            'student_id', 
            'user_id', 
            'school_id', 
            'grade_id',
            'section_id', 
            'address', 
            'dob', 
            'parent_phone', 
            'parent_email'
        ];
}
