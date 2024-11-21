<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGradeSectionCourseTeacherStudent extends Model
{
    use HasFactory;
    protected $fillable = ['school_grade_section_course_teacher_id', 'student_id'];
}
