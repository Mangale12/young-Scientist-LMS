<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title', 
        'description', 
        'unique_id', 
        'video_id', 
        'video_link', 
        'code', 
        'user_id', 
        'course_id', 
        'status', 
        'thumbnail', 
        'chapter_material',
        'chapter_category_id',
    ];

    public function assignment(){
        return $this->hasOne(Assignment::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function chapterCategory()
    {
        return $this->belongsTo(ChapterCategory::class, 'chapter_category_id', 'id'); 
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'chapter_id', 'id');
    }

}
