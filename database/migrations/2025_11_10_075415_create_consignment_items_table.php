<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consignment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consignment_id')->constrained('consignments')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();

            $table->decimal('qty_received', 10, 2)->default(0);
            $table->decimal('qty_sold', 10, 2)->default(0);
            $table->decimal('qty_returned', 10, 2)->default(0);
            $table->decimal('qty_remaining', 10, 2)->default(0);
            $table->decimal('purchase_price', 14, 2)->default(0);
            $table->decimal('sell_price', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consignment_items');
    }
};
