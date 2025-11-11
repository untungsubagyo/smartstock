<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpnameDetail extends Model
{
    use HasFactory;

    protected $table = 'stock_opname_details';

    protected $fillable = [
        'stock_opname_id',
        'item_id',
        'unit_id',
        'system_stock',
        'counted_stock',
        'difference',
        'hpp',
        'value_difference',
        'note',
    ];

    // Relasi ke header opname
    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class);
    }

    // Relasi ke item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi ke unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Hitung otomatis difference & value_difference
    protected static function booted()
    {
        static::saving(function ($detail) {
            $detail->difference = $detail->counted_stock - $detail->system_stock;
            $detail->value_difference = $detail->difference * $detail->hpp;
        });
    }
}
