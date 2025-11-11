<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique()->comment('Kode akun, misal: 1-1001');
            $table->string('name', 150)->comment('Nama akun');
            $table->enum('type', ['ASSET', 'LIABILITY', 'EQUITY', 'REVENUE', 'EXPENSE'])->comment('Jenis akun');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('FK ke akun induk');
            $table->enum('normal_balance', ['DEBIT', 'CREDIT'])->comment('Saldo normal');
            $table->boolean('is_active')->default(true)->comment('Status aktif / tidak');
            $table->timestamps();

            // Relasi ke akun induk
            $table->foreign('parent_id')
                ->references('id')->on('chart_of_accounts')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_of_accounts');
    }
};