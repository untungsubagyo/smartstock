<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBarcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'barcode',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
