<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGradeSection extends Model
{
    use HasFactory;
    protected $fillable = ['school_id', 'grade_id', 'section_id'];

    public function section(){
        return $this->belongsTo(Section::class);
    }

    // public function courses()
    // {
    //     return $this->hasManyThrough(Course::class, SchoolSectionGradeCourse::class, 'school_grade_section_id', 'id', 'id', 'course_id');
    // }

    public function schoolSectionGradeCourses()
    {
        return $this->hasMany(SchoolGradeSectionCourse::class, 'school_grade_section_id');
    }
    public function schoolGradeSectionTeachers(){
        return $this->hasMany(SchoolGradeSectionTeacher::class, 'school_grade_section_id');
    }

    public function schoolGradeSectionGradeStudent(){
        return $this->hasMany(SchoolSectionGradeStudent::class, 'school_grade_section_id');
    }

    public function getCourses($schoolGradeSectionId)
    {
        $schoolGradeSection = SchoolGradeSection::with('courses')
            ->findOrFail($schoolGradeSectionId);

        return $schoolGradeSection->courses;
    }

    // Define the relationship in `SchoolGradeSection`
    public function courses()
    {
        return $this->hasMany(SchoolGradeSectionCourse::class, 'school_grade_section_id');
    }

    // Define the relationship in `SchoolGradeSectionCourse`
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
