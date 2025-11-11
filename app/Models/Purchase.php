<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_no','purchase_order_id','supplier_id','branch_id','user_id',
        'purchase_date','due_date','payment_type','tax_type',
        'subtotal','discount_percent','discount_amount','dpp',
        'tax_amount','total_amount','paid_amount','balance','status','note','sync_status'
    ];

    // Relasi
    public function purchaseOrder() { return $this->belongsTo(PurchaseOrder::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function branch() { return $this->belongsTo(Branch::class); }
    public function user() { return $this->belongsTo(User::class); }
}
