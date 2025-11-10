<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemExtraCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'name',
        'amount',
        'is_active',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
