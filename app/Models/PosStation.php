<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'branch_id',
        'ip_address',
        'database_name',
        'description',
        'connection_status',
        'is_active',
        'last_sync',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
}
