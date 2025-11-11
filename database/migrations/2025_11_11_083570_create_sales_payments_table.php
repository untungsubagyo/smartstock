<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('sales_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_no', 50)
                  ->unique()
                  ->comment('Nomor penerimaan pembayaran (misal: PYT-0001)');

            // Foreign key columns
            $table->unsignedBigInteger('sale_id')->comment('FK ke sales');
            $table->unsignedBigInteger('customer_id')->comment('FK ke customers');
            $table->unsignedBigInteger('branch_id')->comment('FK ke branches');
            $table->unsignedBigInteger('user_id')->nullable()->comment('FK ke users'); // ← Diperbaiki jadi nullable

            // Detail pembayaran
            $table->date('payment_date')->comment('Tanggal pembayaran');
            $table->decimal('total_paid', 14, 2)
                  ->default(0)
                  ->comment('Jumlah dibayar');
            $table->enum('payment_method', [
                'CASH',
                'BANK_TRANSFER',
                'EWALLET',
                'GIRO',
                'OTHERS'
            ])->comment('Jenis pembayaran');
            $table->string('bank_name', 100)
                  ->nullable()
                  ->comment('Nama bank jika non-tunai');
            $table->text('note')->nullable()->comment('Keterangan tambahan');
            $table->enum('status', [
                'DRAFT',
                'POSTED',
                'CANCELLED'
            ])->default('DRAFT')->comment('Status pembayaran');

            $table->timestamps();

            // Foreign keys
            $table->foreign('sale_id')
                  ->references('id')
                  ->on('sales')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('branch_id')
                  ->references('id')
                  ->on('branches')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_payments');
    }
};
