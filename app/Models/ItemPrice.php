<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'min_qty',
        'margin',
        'sale_price',
        'notes',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
