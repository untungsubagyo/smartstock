<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number', 'supplier_id', 'branch_id', 'user_id',
        'order_date', 'delivery_date', 'payment_type', 'tax_type',
        'note', 'subtotal', 'discount_percent', 'discount_amount',
        'dpp', 'tax_amount', 'total_amount', 'status', 'sync_status'
    ];

    // Relasi
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function branch() { return $this->belongsTo(Branch::class); }
    public function user() { return $this->belongsTo(User::class); }
}
