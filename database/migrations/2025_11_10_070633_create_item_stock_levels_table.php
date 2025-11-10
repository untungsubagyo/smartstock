<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_stock_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('cascade');
            $table->decimal('stock_current', 10, 2)->default(0);
            $table->decimal('stock_min', 10, 2)->default(0);
            $table->decimal('stock_max', 10, 2)->default(0);
            $table->timestamps(); // sudah termasuk created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_stock_levels');
    }
};
