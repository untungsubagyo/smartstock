<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'barcode',
        'name',
        'brand',
        'category_id',
        'unit_id',
        'supplier_id',
        'stock',
        'npp',
        'purchase_price',
        'sale_price',
        'sale_price_1',
        'sale_price_2',
        'sale_price_3',
        'sale_price_4',
        'discount_percent',
        'discount_amount',
        'margin',
        'has_ppn',
        'ppn_include',
        'is_bulk',
        'open_price',
        'warranty_days',
        'expired_date',
        'is_active',
        'type_hpp',
    ];

    // Relasi opsional
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
