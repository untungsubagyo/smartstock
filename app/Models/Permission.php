<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $guarded = [];
}

// class Permission extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'code',
//         'name',
//         'module',
//         'description',
//     ];

//     // Relasi ke roles
//     public function roles()
//     {
//         return $this->belongsToMany(Role::class, 'role_permissions')
//                     ->withPivot('granted_at')
//                     ->withTimestamps();
//     }
// }
