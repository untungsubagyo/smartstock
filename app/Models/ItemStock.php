<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'warehouse_id',
        'stock_in',
        'stock_out',
        'stock_balance',
        'last_update',
    ];

    protected $casts = [
        'stock_in' => 'decimal:2',
        'stock_out' => 'decimal:2',
        'stock_balance' => 'decimal:2',
        'last_update' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
