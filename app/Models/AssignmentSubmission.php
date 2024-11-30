<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'assignment_id',
        'student_id',
        'file_path',
        'description',
        'notes',
        'is_viewed',
        'is_replied',
        'teacher_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function assignment(){
        return $this->belongsTo(Assignment::class, 'assignment_id', 'id');
    }
}
