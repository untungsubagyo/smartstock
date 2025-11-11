<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsignmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'consignment_id',
        'item_id',
        'unit_id',
        'qty_received',
        'qty_sold',
        'qty_returned',
        'qty_remaining',
        'purchase_price',
        'sell_price',
        'total',
    ];

    // Relasi
    public function consignment()
    {
        return $this->belongsTo(Consignment::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Hitung otomatis qty_remaining & total
    protected static function booted()
    {
        static::saving(function ($model) {
            $model->qty_remaining = $model->qty_received - $model->qty_sold - $model->qty_returned;
            $model->total = $model->qty_received * $model->purchase_price;
        });
    }
}
