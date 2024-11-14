<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChapterCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name', 'status', 'description', 'thumbnail'];

    public function chapter(){
        return $this->hasMany(Chapter::class);
    }
}
