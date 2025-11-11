<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_no',
        'journal_date',
        'source_module',
        'source_id',
        'description',
        'total_debit',
        'total_credit',
        'status',
    ];

    /**
     * Relasi ke detail jurnal (jika ada)
     */
    public function details()
    {
        return $this->hasMany(JournalDetail::class);
    }

    /**
     * Scope untuk jurnal yang sudah diposting
     */
    public function scopePosted($query)
    {
        return $query->where('status', 'POSTED');
    }
}
