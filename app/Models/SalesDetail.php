<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'item_id',
        'variant_id',
        'barcode',
        'item_name',
        'qty',
        'unit_id',
        'price',
        'discount_percent',
        'discount_amount',
        'tax_percent',
        'tax_amount',
        'total',
    ];

    public function sale() { return $this->belongsTo(Sale::class); }
    public function item() { return $this->belongsTo(Item::class); }
    public function variant() { return $this->belongsTo(ItemVariant::class); }
    public function unit() { return $this->belongsTo(Unit::class); }
}
