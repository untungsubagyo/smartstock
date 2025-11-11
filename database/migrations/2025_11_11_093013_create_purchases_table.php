<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_no', 50)->unique();
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->onDelete('set null');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('branch_id')->constrained('branches');
            $table->foreignId('user_id')->constrained('users');
            $table->date('purchase_date');
            $table->date('due_date')->nullable();
            $table->enum('payment_type', ['TUNAI','KREDIT']);
            $table->enum('tax_type', ['TIDAK_PPN','PPN_INCLUDE','PPN_EXCLUDE']);
            $table->decimal('subtotal', 14,2)->default(0);
            $table->decimal('discount_percent', 5,2)->default(0);
            $table->decimal('discount_amount', 14,2)->default(0);
            $table->decimal('dpp', 14,2)->default(0);
            $table->decimal('tax_amount', 14,2)->default(0);
            $table->decimal('total_amount', 14,2)->default(0);
            $table->decimal('paid_amount', 14,2)->default(0);
            $table->decimal('balance', 14,2)->default(0);
            $table->enum('status', ['DRAFT','POSTED','PAID','CANCELLED'])->default('DRAFT');
            $table->text('note')->nullable();
            $table->enum('sync_status', ['PENDING','SYNCED','FAILED'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

