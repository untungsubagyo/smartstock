<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPack extends Model
{
    protected $table = 'item_packs';

    protected $fillable = [
        'item_id',
        'unit_id',
        'pack_name',
        'qty_per_pack',
        'hpp_per_pack',
        'margin',
        'sale_price',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    // Relationships
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
