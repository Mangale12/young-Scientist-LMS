<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unique_key', 'school_id'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_grades');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_grade', 'grade_id', 'school_id');
    }

    public function schoolsWithGrade()
    {
        return $this->belongsToMany(School::class, 'school_grade_sections')->withPivot('section_id')->withTimestamps();
    }


}
