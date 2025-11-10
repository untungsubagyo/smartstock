<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('tax_type', 50); // Jenis pajak (PPN, PPnBM, dll)
            $table->decimal('rate', 5, 2)->default(0); // Persentase pajak
            $table->boolean('included')->default(false); // Sudah termasuk harga jual?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_taxes');
    }
};
