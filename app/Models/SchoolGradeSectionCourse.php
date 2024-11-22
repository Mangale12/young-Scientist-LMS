<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGradeSectionCourse extends Model
{
    use HasFactory;
    protected $fillable = ['school_grade_section_id', 'course_id'];
    public function schoolGradeSection()
    {
        return $this->belongsTo(SchoolGradeSection::class, 'school_grade_section_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function schoolGradeSectionCourseTeacher(){
        return $this->hasMany(SchoolGradeSectionCourseTeacher::class, 's_g_s_c_id');
    }

    // To retrieve the latest teacher
    public function latestSchoolGradeSectionCourseTeacher()
    {
        return $this->hasOne(SchoolGradeSectionCourseTeacher::class, 's_g_s_c_id')->latest();
    }

    
}
