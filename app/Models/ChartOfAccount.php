<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'parent_id',
        'normal_balance',
        'is_active',
    ];

    /**
     * Relasi ke akun induk
     */
    public function parent()
    {
        return $this->belongsTo(ChartOfAccount::class, 'parent_id');
    }

    /**
     * Relasi ke akun anak
     */
    public function children()
    {
        return $this->hasMany(ChartOfAccount::class, 'parent_id');
    }

    /**
     * Scope: hanya akun aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: akun berdasarkan tipe (ASSET, LIABILITY, dsb)
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
}
