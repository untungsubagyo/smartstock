<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number', 50)->unique();
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('branch_id')->constrained('branches');
            $table->foreignId('user_id')->constrained('users');
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->enum('payment_type', ['TUNAI','KREDIT']);
            $table->enum('tax_type', ['TIDAK_PPN','PPN_INCLUDE','PPN_EXCLUDE']);
            $table->text('note')->nullable();
            $table->decimal('subtotal', 14,2)->default(0);
            $table->decimal('discount_percent', 5,2)->default(0);
            $table->decimal('discount_amount', 14,2)->default(0);
            $table->decimal('dpp', 14,2)->default(0);
            $table->decimal('tax_amount', 14,2)->default(0);
            $table->decimal('total_amount', 14,2)->default(0);
            $table->enum('status', ['DRAFT','APPROVED','RECEIVED','CANCELLED'])->default('DRAFT');
            $table->enum('sync_status', ['PENDING','SYNCED','FAILED'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
