<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_id',
        'account_id',
        'debit',
        'credit',
        'note',
    ];

    /**
     * Relasi ke jurnal utama
     */
    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    /**
     * Relasi ke akun COA
     */
    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }
}
