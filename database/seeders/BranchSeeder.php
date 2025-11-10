<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::firstOrCreate(
            ['code' => 'PST'],
            [
                'name' => 'Pusat',
                'address' => 'Jl. Lawu No. 1, Matesih, Karanganyar',
                'city' => 'Karanganyar',
                'province' => 'Jawa Tengah',
                'phone' => '0271-123456',
                'email' => 'info@smartstock.local',
                'is_main' => true,
                'is_active' => true,
            ]
        );
    }
}
