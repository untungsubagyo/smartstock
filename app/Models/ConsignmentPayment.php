<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsignmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consignment_id',
        'supplier_id',
        'payment_date',
        'total_sold',
        'commission_percent',
        'amount_paid',
        'note',
        'status',
    ];

    public function consignment()
    {
        return $this->belongsTo(Consignment::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
