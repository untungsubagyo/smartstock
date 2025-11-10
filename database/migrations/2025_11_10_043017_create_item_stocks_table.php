<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->decimal('stock_in', 10, 2)->default(0);
            $table->decimal('stock_out', 10, 2)->default(0);
            $table->decimal('stock_balance', 10, 2)->default(0);
            $table->timestamp('last_update')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_stocks');
    }
};
