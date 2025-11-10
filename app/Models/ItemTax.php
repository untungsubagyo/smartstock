<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTax extends Model
{
    protected $table = 'item_taxes';

    protected $fillable = [
        'item_id',
        'tax_type',
        'rate',
        'included',
    ];

    protected $casts = [
        'included' => 'boolean',
    ];

    // Relasi ke Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
