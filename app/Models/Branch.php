<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'address',
        'city',
        'province',
        'phone',
        'email',
        'logo_path',
        'is_main',
        'status',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    /**
     * Relasi ke user (satu cabang bisa punya banyak user)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
