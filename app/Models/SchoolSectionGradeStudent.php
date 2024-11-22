<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSectionGradeStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_grade_section_id', 'student_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    
    public function schoolGradeSection(){
        return $this->belongsTo(SchoolGradeSection::class);
    }
}
