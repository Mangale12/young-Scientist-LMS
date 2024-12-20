<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseResource extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'file_path', 'unique_id', 'status'];
}
