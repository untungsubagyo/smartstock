<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            $table->string('opname_no', 50)->unique()->comment('Nomor opname, misal: SO-20251109-001');
            $table->unsignedBigInteger('branch_id')->comment('FK ke branches');
            $table->unsignedBigInteger('warehouse_id')->nullable()->comment('FK ke warehouses (jika multi gudang)');
            $table->unsignedBigInteger('user_id')->comment('FK ke users yang melakukan opname');
            $table->date('opname_date')->comment('Tanggal opname');
            $table->integer('total_items')->default(0)->comment('Total barang yang diopname');
            $table->decimal('total_value', 14, 2)->default(0)->comment('Nilai total stok opname (berdasarkan HPP)');
            $table->text('note')->nullable()->comment('Catatan tambahan');
            $table->enum('status', ['DRAFT','POSTED','CANCELLED'])->default('DRAFT')->comment('Status opname');
            $table->timestamps();

            // Foreign key
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_opnames');
    }
};