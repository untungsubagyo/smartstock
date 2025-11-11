<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->decimal('qty', 10, 2);
            $table->decimal('price', 14, 2);
            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->decimal('discount_amount', 14, 2)->nullable();
            $table->enum('discount_type', ['percent', 'amount', 'none'])->default('none');
            $table->decimal('net_price', 14, 2)->nullable();
            $table->decimal('subtotal', 14, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
