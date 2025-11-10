<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_barcode_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->string('barcode', 100);
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->integer('qty_pcs')->default(1);
            $table->decimal('hpp', 12, 2)->default(0);
            $table->decimal('margin', 5, 2)->default(0);
            $table->decimal('sale_price', 12, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_barcode_prices');
    }
};
