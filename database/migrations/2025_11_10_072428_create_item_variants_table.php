<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('color', 50)->nullable();
            $table->string('size', 50)->nullable();
            $table->string('type', 50)->nullable(); // Misal: bahan, model, rasa, dsb
            $table->string('sku', 50)->unique(); // SKU varian
            $table->decimal('stock', 12, 2)->default(0);
            $table->decimal('price', 12, 2)->nullable(); // Jika null → ikut harga default
            $table->string('barcode', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_variants');
    }
};
