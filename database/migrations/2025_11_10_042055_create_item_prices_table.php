<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('min_qty')->default(1);                // Batas minimal qty
            $table->decimal('margin', 5, 2)->nullable();           // Margin %
            $table->decimal('sale_price', 12, 2)->nullable();      // Harga jual grosir
            $table->text('notes')->nullable();                     // Catatan opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_prices');
    }
};
