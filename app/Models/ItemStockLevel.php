<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStockLevel extends Model
{
    protected $table = 'item_stock_levels';

    protected $fillable = [
        'item_id',
        'branch_id',
        'warehouse_id',
        'stock_current',
        'stock_min',
        'stock_max',
    ];

    // Relationships
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
