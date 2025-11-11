<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchasePayment;
use Illuminate\Support\Facades\DB;

class PurchasePaymentSeeder extends Seeder
{
    public function run(): void
    {
        if (
            DB::table('suppliers')->count() === 0 ||
            DB::table('branches')->count() === 0 ||
            DB::table('users')->count() === 0
        ) {
            $this->command->warn('⚠️ Seeder dibatalkan: tabel supplier/branch/user belum ada data!');
            return;
        }

        $suppliers = DB::table('suppliers')->pluck('id')->toArray();
        $branches = DB::table('branches')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 20) as $i) {
            $method = fake()->randomElement(['CASH', 'BANK_TRANSFER', 'GIRO', 'OTHERS']);
            PurchasePayment::create([
                'payment_no' => 'PYH-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'supplier_id' => fake()->randomElement($suppliers),
                'branch_id' => fake()->randomElement($branches),
                'user_id' => fake()->randomElement($users),
                'payment_date' => fake()->date(),
                'total_paid' => fake()->randomFloat(2, 50000, 5000000),
                'payment_method' => $method,
                'bank_name' => $method === 'BANK_TRANSFER' ? fake()->company() : null,
                'note' => fake()->sentence(),
                'status' => fake()->randomElement(['DRAFT', 'POSTED', 'CANCELLED']),
            ]);
        }

        $this->command->info('✅ Seeder PurchasePaymentSeeder berhasil dijalankan!');
    }
}
