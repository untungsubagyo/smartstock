<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->comment('FK ke items');
            $table->string('ref_no', 50)->nullable()->comment('Nomor referensi transaksi');
            $table->string('ref_type', 50)->comment('Tipe referensi: PURCHASE, SALE, RETURN, OPNAME, ADJUSTMENT, TRANSFER');
            $table->decimal('qty_in', 10, 2)->default(0)->comment('Jumlah masuk');
            $table->decimal('qty_out', 10, 2)->default(0)->comment('Jumlah keluar');
            $table->decimal('stock_before', 10, 2)->default(0)->comment('Stok sebelum transaksi');
            $table->decimal('stock_after', 10, 2)->default(0)->comment('Stok setelah transaksi');
            $table->unsignedBigInteger('warehouse_id')->nullable()->comment('FK ke warehouses');
            $table->unsignedBigInteger('user_id')->nullable()->comment('FK ke users');
            $table->text('note')->nullable();
            $table->timestamps();

            // Relasi FK
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};