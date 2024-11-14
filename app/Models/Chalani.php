<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chalani extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'no', 'fiscal_year_id', 'date', 'name', 'branch', 'remarks'];

    public function fiscalYear(){
        return $this->belongsTo(FiscalYear::class);
    }

    public function chalaniImages(){
        return $this->hasMany(Image::class, 'chalani_id');
    }
}
