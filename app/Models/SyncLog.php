<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncLog extends Model
{
    use HasFactory;

    public $timestamps = false; // Karena kita pakai updated_at manual

    protected $fillable = [
        'table_name',
        'record_id',
        'action',
        'updated_at',
        'created_by',
        'sent_to_client',
        'sent_at',
    ];
}
