<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'title',
        'description',
        'unique_id',
        'video_id',
        'video_link',
        'code',
        'user_id',
        'cost',
        'status',
        'thumbnail',
        'course_material',
        ''
    ];
    protected $dates = ['deleted_at'];
    public function chapter(){
        return $this->hasMany(Chapter::class, 'course_id')->with('chapterCategory');
    }

    public function courseResources()
    {
        return $this->belongsToMany(CourseResource::class, 'course_course_resources');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'course_schools');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_courses');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'course_grades');
    }

}
