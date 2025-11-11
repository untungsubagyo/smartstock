<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConsignmentItem;

class ConsignmentItemSeeder extends Seeder
{
    public function run(): void
    {
        ConsignmentItem::factory()->count(10)->create();
    }
}
