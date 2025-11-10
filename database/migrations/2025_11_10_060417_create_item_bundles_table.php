<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_bundles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_item_id')->constrained('items')->cascadeOnDelete();
            $table->foreignId('child_item_id')->constrained('items')->cascadeOnDelete();
            $table->decimal('qty', 12, 2)->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_bundles');
    }
};
