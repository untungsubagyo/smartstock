<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $table = 'stock_movements';

    protected $fillable = [
        'item_id',
        'ref_no',
        'ref_type',
        'qty_in',
        'qty_out',
        'stock_before',
        'stock_after',
        'warehouse_id',
        'user_id',
        'note',
    ];

    // Relasi ke item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi ke gudang
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hitung otomatis stok sebelum dan sesudah.
     * Biasanya dipanggil saat mencatat transaksi stok.
     */
    public static function recordMovement($data)
    {
        $item = Item::findOrFail($data['item_id']);

        $currentStock = $item->stock ?? 0;
        $qtyIn = $data['qty_in'] ?? 0;
        $qtyOut = $data['qty_out'] ?? 0;
        $newStock = $currentStock + $qtyIn - $qtyOut;

        // Simpan pergerakan
        $movement = self::create([
            'item_id' => $item->id,
            'ref_no' => $data['ref_no'] ?? null,
            'ref_type' => $data['ref_type'],
            'qty_in' => $qtyIn,
            'qty_out' => $qtyOut,
            'stock_before' => $currentStock,
            'stock_after' => $newStock,
            'warehouse_id' => $data['warehouse_id'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'note' => $data['note'] ?? null,
        ]);

        // Update stok di tabel items
        $item->update(['stock' => $newStock]);

        return $movement;
    }
}
