<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReceivable extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_no',
        'transaction_date',
        'due_date',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
