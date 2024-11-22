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

        public function user(){
            return $this->belongsTo(User::class);
        }
        public function school(){
            return $this->belongsTo(School::class);
        }
        public function grade(){
            return $this->belongsTo(Grade::class);
        }
        public function schoolSectionGradeStudent(){
            return $this->hasOne(SchoolSectionGradeStudent::class, 'student_id');
        }
        
}
