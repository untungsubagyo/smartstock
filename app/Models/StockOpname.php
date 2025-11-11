<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $table = 'stock_opnames';

    protected $fillable = [
        'opname_no',
        'branch_id',
        'warehouse_id',
        'user_id',
        'opname_date',
        'total_items',
        'total_value',
        'note',
        'status',
    ];

    // 🔗 Relasi ke tabel lain
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🧮 Contoh fungsi helper untuk auto nomor opname
    protected static function booted()
    {
        static::creating(function ($opname) {
            $last = self::orderBy('id', 'desc')->first();
            $next = $last ? $last->id + 1 : 1;
            $opname->opname_no = 'SO-' . date('Ymd') . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);
        });
    }
}
