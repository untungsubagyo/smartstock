<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sync_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_station_id')->constrained('pos_stations')->onDelete('cascade');
            $table->enum('direction', ['PUSH', 'PULL']);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->integer('total_records')->default(0);
            $table->integer('success_count')->default(0);
            $table->integer('failed_count')->default(0);
            $table->enum('status', ['SUCCESS', 'PARTIAL', 'FAILED'])->default('SUCCESS');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sync_histories');
    }
};
