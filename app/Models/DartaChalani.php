<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DartaChalani extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function fiscalYear(){
        return $this->belongsTo(FiscalYear::class);
    }

    public function office(){
        return $this->belongsTo(Office::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function documentType(){
        return $this->belongsTo(DocumentType::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
