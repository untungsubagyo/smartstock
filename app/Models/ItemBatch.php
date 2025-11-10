<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'batch_code',
        'expired_date',
        'warranty_days',
        'qty',
    ];

    protected $casts = [
        'expired_date' => 'date',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
