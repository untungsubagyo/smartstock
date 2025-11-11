<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConsignmentPayment;

class ConsignmentPaymentSeeder extends Seeder
{
    public function run(): void
    {
        ConsignmentPayment::factory()->count(10)->create();
    }
}
