<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransferItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_transfer_id',
        'item_id',
        'unit_id',
        'qty',
        'purchase_price',
        'total',
        'note',
    ];

    // Relasi
    public function stockTransfer()
    {
        return $this->belongsTo(StockTransfer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Accessor total otomatis (jika tidak disimpan di DB)
    protected $appends = ['computed_total'];

    public function getComputedTotalAttribute()
    {
        return $this->qty * $this->purchase_price;
    }
}
