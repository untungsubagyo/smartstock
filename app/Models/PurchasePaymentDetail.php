<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_payment_id',
        'purchase_id',
        'amount',
        'remaining',
    ];

    public function purchasePayment()
    {
        return $this->belongsTo(PurchasePayment::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
