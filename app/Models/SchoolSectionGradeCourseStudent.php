<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSectionGradeCourseStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_grade_section_id',
        'course_id',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function schoolGradeSection(){
        return $this->belongsTo(SchoolGradeSection::class);
    }
}
