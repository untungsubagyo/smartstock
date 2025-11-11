<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id', 'item_id', 'unit_id',
        'qty', 'purchase_price', 'discount_percent',
        'discount_amount', 'net_price', 'total'
    ];

    // Relasi
    public function purchaseOrder() { return $this->belongsTo(PurchaseOrder::class); }
    public function item() { return $this->belongsTo(Item::class); }
    public function unit() { return $this->belongsTo(Unit::class); }
}

