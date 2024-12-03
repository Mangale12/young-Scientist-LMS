<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'unique_id',
        'chapter_id',
        'chapter_category_id',
        'description',
        'materials',
        'is_complete',
        'course_id'
    ];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
    public function assignment(){
        return $this->hasOne(Assignment::class, 'topic_id', 'id');
    }
}
