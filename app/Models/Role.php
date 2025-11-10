<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $guarded = [];
}
// class Role extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'code',
//         'name',
//         'description',
//         'is_system',
//     ];

//     protected $casts = [
//         'is_system' => 'boolean',
//     ];

//     // Relasi ke users
//     public function users()
//     {
//         return $this->hasMany(User::class);
//     }

//     // Relasi ke permissions melalui pivot
//     public function permissions()
//     {
//         return $this->belongsToMany(Permission::class, 'role_permissions')
//                     ->withPivot('granted_at')
//                     ->withTimestamps();
//     }

//     // Relasi ke user_roles (pivot langsung)
//     public function userRoles()
//     {
//         return $this->hasMany(UserRole::class);
//     }
// }
