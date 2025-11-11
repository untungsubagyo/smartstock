<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consignment;

class ConsignmentSeeder extends Seeder
{
    public function run(): void
    {
        Consignment::create([
            'consignment_no' => 'KS-00001',
            'supplier_id' => 1,
            'branch_id' => 1,
            'user_id' => 1,
            'consignment_date' => now(),
            'subtotal' => 500000,
            'discount_percent' => 5,
            'discount_amount' => 25000,
            'tax_amount' => 47500,
            'total_amount' => 522500,
            'note' => 'Barang titipan supplier A',
            'status' => 'DRAFT',
            'sync_status' => 'PENDING',
        ]);
    }
}
