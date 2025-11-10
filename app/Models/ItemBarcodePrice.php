<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBarcodePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'barcode',
        'unit_id',
        'qty_pcs',
        'hpp',
        'margin',
        'sale_price',
        'is_active',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getComputedSalePriceAttribute()
    {
        return $this->hpp + ($this->hpp * $this->margin / 100);
    }
}
