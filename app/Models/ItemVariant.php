<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVariant extends Model
{
    protected $table = 'item_variants';

    protected $fillable = [
        'item_id',
        'color',
        'size',
        'type',
        'sku',
        'stock',
        'price',
        'barcode',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stock' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
