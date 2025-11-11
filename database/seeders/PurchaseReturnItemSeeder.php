<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseReturnItem;

class PurchaseReturnItemSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseReturnItem::factory()->count(10)->create();
    }
}
