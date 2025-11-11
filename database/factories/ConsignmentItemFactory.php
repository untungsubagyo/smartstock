<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consignment;
use App\Models\Item;
use App\Models\Unit;

class ConsignmentItemFactory extends Factory
{
    public function definition(): array
    {
        $qty = $this->faker->numberBetween(10, 100);
        $price = $this->faker->randomFloat(2, 10000, 50000);

        return [
            'consignment_id' => Consignment::factory(),
            'item_id' => Item::factory(),
            'unit_id' => Unit::factory(),
            'qty_received' => $qty,
            'qty_sold' => $this->faker->numberBetween(0, $qty),
            'qty_returned' => $this->faker->numberBetween(0, 5),
            'purchase_price' => $price,
            'sell_price' => $price * 1.2,
            'total' => $qty * $price,
        ];
    }
}
