<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasRoles; // Ensure this is imported

class Role extends SpatieRole
{
    use HasFactory, HasRoles; // Ensure HasRoles is used
    protected $fillable = ['name', 'guard_name']; // Ensure name and guard_name are mass assignable
}

