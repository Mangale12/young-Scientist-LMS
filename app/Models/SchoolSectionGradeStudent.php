<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSectionGradeStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id', 'grade_id', 'section_id', 'student_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function school(){
        return $this->belongsTo(School::class);
    }
    
}
