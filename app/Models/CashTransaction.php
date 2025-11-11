<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no',
        'transaction_date',
        'entry_date',
        'user_id',
        'transaction_name',
        'transaction_type',
        'amount',
        'note',
        'status',
    ];

    /**
     * Relasi ke user (petugas yang input transaksi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: hanya transaksi yang sudah diposting
     */
    public function scopePosted($query)
    {
        return $query->where('status', 'POSTED');
    }

    /**
     * Scope: hanya transaksi draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'DRAFT');
    }
}
