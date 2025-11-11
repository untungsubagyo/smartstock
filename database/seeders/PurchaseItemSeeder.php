<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseItem;

class PurchaseItemSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseItem::factory()->count(10)->create();
    }
}
