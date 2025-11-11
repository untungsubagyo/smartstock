<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pos_stations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->string('ip_address', 50)->nullable();
            $table->string('database_name', 50)->nullable();
            $table->text('description')->nullable();
            $table->enum('connection_status', ['Terhubung', 'Terputus'])->default('Terputus');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pos_stations');
    }
};
