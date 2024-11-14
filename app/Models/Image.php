<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Image extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['document_type_id', 'image_path', 'created_at', 'updated_at'];

    public function document(){
        return $this->belongsTo(DocumentType::class, 'document_type_id');  // Assuming Document has a foreign key named document_id  // Assuming Document has a relationship named images which is a hasMany relationship with Image model.  // Assuming Document model has a hasOne relationship with Image model.  // Assuming Document model has a hasManyThrough relationship with Image model.  // Assuming Document model has a morphMany relationship with Image model.  // Assuming Document model has a morphOne relationship with Image model.  // Assuming Document model has a morphTo relationship with Image model.  // Assuming Document model has a morphToMany relationship with Image model.  // Assuming Document model has a morphToMany relationship with Image model through a pivot table named document_images.  // Assuming Document model has a polymorphic relationship with Image model.  // Assuming Document model has a polymorphic relationship with Image model through a pivot table named document_images.  // Assuming Document
    }
}
