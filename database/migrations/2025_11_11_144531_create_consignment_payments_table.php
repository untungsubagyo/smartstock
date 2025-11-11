<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consignment_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consignment_id')->constrained('consignments')->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->date('payment_date');
            $table->decimal('total_sold', 14, 2);
            $table->decimal('commission_percent', 5, 2)->nullable();
            $table->decimal('amount_paid', 14, 2);
            $table->text('note')->nullable();
            $table->enum('status', ['PENDING', 'PAID', 'CANCELLED'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consignment_payments');
    }
};
