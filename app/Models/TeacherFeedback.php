<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'assignment_submission_id',
        'feedback',
        'is_viewed',
        'rating', 
        'file_path', 
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function assignmentSubmission(){
        return $this->belongsTo(AssignmentSubmission::class, 'assignment_submission_id');
    }
}
