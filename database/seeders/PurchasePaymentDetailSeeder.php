<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchasePaymentDetail;

class PurchasePaymentDetailSeeder extends Seeder
{
    public function run(): void
    {
        PurchasePaymentDetail::factory()->count(10)->create();
    }
}
