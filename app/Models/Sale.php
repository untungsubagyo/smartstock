<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'branch_id',
        'pos_station_id',
        'user_id',
        'customer_id',
        'sale_date',
        'subtotal',
        'discount_amount',
        'discount_percent',
        'tax_amount',
        'total_amount',
        'payment_method',
        'amount_paid',
        'change_amount',
        'note',
        'status',
        'sync_status',
    ];

    public function branch() { return $this->belongsTo(Branch::class); }
    public function posStation() { return $this->belongsTo(PosStation::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
}
