<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unique_key', 'grade_id', 'school_id'];
    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_grade_sections')->withPivot('grade_id')->withTimestamps();
    }

}


