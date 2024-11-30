<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'topic_id', 
        'description', 
        'file_path', 
        'unique_id', 
        'due_date', 
        'user_id'
    ];

    public function assignmentSubmission(){
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id', 'id');
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
