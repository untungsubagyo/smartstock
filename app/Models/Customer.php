<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'code',
        'name',
        'address',
        'district',
        'phone',
        'mobile',
        'email',
        'fax',
        'website',
        'npwp',
        'npwp_name',
        'npwp_address',
        'npwp_date',
        'total_receivable',
        'credit_limit',
        'customer_type',
        'wholesale_price_type',
        'status',
        'card_number'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            // Kalau belum diisi manual, generate otomatis
            if (empty($customer->code)) {
                $customer->code = 'CUS-' . strtoupper(uniqid());
            }
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
