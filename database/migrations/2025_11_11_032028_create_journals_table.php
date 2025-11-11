<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('journal_no', 50)->unique();
            $table->date('journal_date');
            $table->string('source_module', 50)->nullable()->comment('Misal: SALES, PURCHASE, CASH, STOCK');
            $table->unsignedBigInteger('source_id')->nullable()->comment('ID transaksi asal');
            $table->text('description')->nullable();
            $table->decimal('total_debit', 14, 2)->default(0);
            $table->decimal('total_credit', 14, 2)->default(0);
            $table->enum('status', ['POSTED', 'VOID'])->default('POSTED');
            $table->timestamps();

            $table->index(['source_module', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};