<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_no', 50)->unique(); // Nomor bayar hutang
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('payment_date');
            $table->decimal('total_paid', 14, 2);
            $table->enum('payment_method', ['CASH', 'BANK_TRANSFER', 'GIRO', 'OTHERS']);
            $table->string('bank_name', 100)->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['DRAFT', 'POSTED', 'CANCELLED'])->default('DRAFT');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_payments');
    }
};
