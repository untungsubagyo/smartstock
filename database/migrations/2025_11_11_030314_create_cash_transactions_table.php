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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no', 50)->unique()->comment('Nomor transaksi');
            $table->date('transaction_date')->comment('Tanggal transaksi');
            $table->date('entry_date')->comment('Tanggal input');
            $table->unsignedBigInteger('user_id')->comment('FK ke users');
            $table->string('transaction_name', 150)->comment('Nama transaksi (misal: Bayar Listrik, Setoran Modal)');
            $table->enum('transaction_type', ['CASH_IN', 'CASH_OUT'])->comment('Masuk / Keluar');
            $table->decimal('amount', 14, 2)->default(0)->comment('Jumlah transaksi');
            $table->text('note')->nullable()->comment('Catatan tambahan');
            $table->enum('status', ['DRAFT', 'POSTED'])->default('DRAFT')->comment('Status transaksi');
            $table->timestamps();

            // Relasi
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};