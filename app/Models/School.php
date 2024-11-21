<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unnique_key'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_schools');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'school_grades', 'school_id', 'grade_id');
    }

    public function gradeWithSection()
    {
        return $this->belongsToMany(Grade::class, 'school_grade_sections')->withPivot('section_id')->withTimestamps();
    }

    public function schoolGradeSections()
    {
        return $this->hasMany(SchoolGradeSection::class, 'school_id');
    }

    public function schoolGradeSectionGradeStudent(){
        return $this->hasMany(SchoolSectionGradeStudent::class, 'school_id');
    }

    public function schoolGradeSectionGradeCourse()
    {
        return $this->hasMany(SchoolSectionGradeCourse::class, 'school_id');
    }



}
