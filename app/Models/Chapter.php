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
        'chapter_cataegory_id',
    ];

}
