<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');               // Primary key
            $table->string('code', 20)->unique();      // Kode supplier
            $table->string('name', 150);               // Nama perusahaan
            $table->text('address')->nullable();       // Alamat
            $table->string('phone', 30)->nullable();   // Telepon
            $table->string('email', 100)->nullable();  // Email
            $table->timestamps();                      // created_at & updated_at
        });
    }

    /**
     * Hapus tabel jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
