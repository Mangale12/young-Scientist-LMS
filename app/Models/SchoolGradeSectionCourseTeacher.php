<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGradeSectionCourseTeacher extends Model
{
    use HasFactory;
    protected $fillable = ['s_g_s_c_id', 'teacher_id'];

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
