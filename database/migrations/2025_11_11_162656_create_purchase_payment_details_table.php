<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_payment_id')->constrained('purchase_payments')->cascadeOnDelete();
            $table->foreignId('purchase_id')->constrained('purchases')->cascadeOnDelete();
            $table->decimal('amount', 14, 2)->default(0);
            $table->decimal('remaining', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_payment_details');
    }
};
