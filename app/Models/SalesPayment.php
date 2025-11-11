<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    use HasFactory;

    protected $table = 'sales_payments';

    protected $fillable = [
        'payment_no',
        'sale_id',
        'customer_id',
        'branch_id',
        'user_id',
        'payment_date',
        'total_paid',
        'payment_method',
        'bank_name',
        'note',
        'status',
    ];

    // Relasi ke tabel Sales
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi ke Cabang
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // Relasi ke User (kasir/admin)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Generate nomor otomatis (PYT-0001, dst)
    protected static function booted()
    {
        static::creating(function ($payment) {
            $last = self::orderBy('id', 'desc')->first();
            $nextNumber = $last ? $last->id + 1 : 1;
            $payment->payment_no = 'PYT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
