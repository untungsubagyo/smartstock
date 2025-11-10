<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'promo_name',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'description',
        'is_active',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getFormattedDiscountAttribute()
    {
        return $this->discount_type === 'percent'
            ? $this->discount_value . '%'
            : 'Rp ' . number_format($this->discount_value, 2);
    }
}
