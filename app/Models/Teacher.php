<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id','subject_expert', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
