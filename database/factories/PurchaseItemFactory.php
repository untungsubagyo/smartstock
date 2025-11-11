<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\Unit;

class PurchaseItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'purchase_id' => Purchase::inRandomOrder()->value('id') ?? 1,
            'item_id' => Item::inRandomOrder()->value('id') ?? 1,
            'unit_id' => Unit::inRandomOrder()->value('id') ?? 1,
            'qty' => $this->faker->randomFloat(2, 1, 50),
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'discount_percent' => $this->faker->randomFloat(2, 0, 20),
            'discount_amount' => $this->faker->randomFloat(2, 0, 10000),
            'discount_type' => $this->faker->randomElement(['percent', 'amount', 'none']),
            'net_price' => $this->faker->randomFloat(2, 10000, 500000),
            'subtotal' => $this->faker->randomFloat(2, 50000, 2000000),
        ];
    }
}
