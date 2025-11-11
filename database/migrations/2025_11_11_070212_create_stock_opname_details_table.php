<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_opname_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_opname_id')->comment('FK ke stock_opnames');
            $table->unsignedBigInteger('item_id')->comment('FK ke items');
            $table->unsignedBigInteger('unit_id')->comment('FK ke units');
            $table->decimal('system_stock', 10, 2)->default(0)->comment('Stok tercatat di sistem');
            $table->decimal('counted_stock', 10, 2)->default(0)->comment('Stok hasil hitungan fisik');
            $table->decimal('difference', 10, 2)->default(0)->comment('counted_stock - system_stock');
            $table->decimal('hpp', 14, 2)->default(0)->comment('Harga pokok per unit');
            $table->decimal('value_difference', 14, 2)->default(0)->comment('difference × hpp');
            $table->text('note')->nullable()->comment('Keterangan tambahan');
            $table->timestamps();

            // Relasi FK
            $table->foreign('stock_opname_id')->references('id')->on('stock_opnames')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_opname_details');
    }
};