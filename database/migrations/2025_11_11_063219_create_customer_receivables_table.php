<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_receivables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('invoice_no', 50);
            $table->date('transaction_date');
            $table->date('due_date');
            $table->decimal('total_amount', 14, 2);
            $table->decimal('paid_amount', 14, 2)->default(0);
            $table->decimal('remaining_amount', 14, 2)->default(0);
            $table->enum('status', ['LUNAS', 'BELUM_LUNAS'])->default('BELUM_LUNAS');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_receivables');
    }
};
