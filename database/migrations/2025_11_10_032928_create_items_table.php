<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('barcode', 100)->nullable();
            $table->string('name', 150);
            $table->string('brand', 100)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->decimal('stock', 10, 2)->default(0);
            $table->decimal('npp', 12, 2)->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->decimal('sale_price', 12, 2)->nullable();

            $table->decimal('sale_price_1', 12, 2)->nullable();
            $table->decimal('sale_price_2', 12, 2)->nullable();
            $table->decimal('sale_price_3', 12, 2)->nullable();
            $table->decimal('sale_price_4', 12, 2)->nullable();

            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->decimal('discount_amount', 12, 2)->nullable();
            $table->decimal('margin', 5, 2)->nullable();

            $table->boolean('has_ppn')->default(false);
            $table->boolean('ppn_include')->default(false);

            $table->boolean('is_bulk')->default(false);
            $table->decimal('open_price', 12, 2)->nullable();
            $table->integer('warranty_days')->nullable();
            $table->date('expired_date')->nullable();

            $table->boolean('is_active')->default(true);
            $table->enum('type_hpp', ['rata2', 'fifo', 'lifo'])->default('rata2');

            $table->timestamps();

            // Optional foreign keys (bisa diaktifkan jika tabel referensi ada)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
