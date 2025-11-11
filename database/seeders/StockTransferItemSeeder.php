<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockTransferItem;
use Illuminate\Support\Facades\DB;

class StockTransferItemSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan sudah ada data di tabel stock_transfers, items, dan units
        // agar FK tidak error
        if (DB::table('stock_transfers')->count() === 0 ||
            DB::table('items')->count() === 0 ||
            DB::table('units')->count() === 0) {
            $this->command->warn('⚠️ Seeder dibatalkan: Pastikan tabel stock_transfers, items, dan units sudah berisi data!');
            return;
        }

        $stockTransfers = DB::table('stock_transfers')->pluck('id')->toArray();
        $items = DB::table('items')->pluck('id')->toArray();
        $units = DB::table('units')->pluck('id')->toArray();

        foreach (range(1, 20) as $i) {
            $qty = fake()->randomFloat(2, 1, 100);
            $price = fake()->randomFloat(2, 5000, 100000);
            
            StockTransferItem::create([
                'stock_transfer_id' => fake()->randomElement($stockTransfers),
                'item_id' => fake()->randomElement($items),
                'unit_id' => fake()->randomElement($units),
                'qty' => $qty,
                'purchase_price' => $price,
                'total' => $qty * $price,
                'note' => fake()->optional()->sentence(),
            ]);
        }

        $this->command->info('✅ Seeder StockTransferItemSeeder berhasil dijalankan!');
    }
}
