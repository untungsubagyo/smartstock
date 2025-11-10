<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_barcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('barcode', 100)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_barcodes');
    }
};
