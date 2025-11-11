<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consignment_no',
        'supplier_id',
        'branch_id',
        'user_id',
        'consignment_date',
        'due_date',
        'subtotal',
        'discount_percent',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'note',
        'status',
        'sync_status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
