<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branchess', function (Blueprint $table) {
            $table->id(); // id bigint primary key
            $table->string('code', 10)->unique(); // Kode unik cabang
            $table->string('name', 100); // Nama cabang
            $table->text('address'); // Alamat lengkap
            $table->string('city', 100); // Kota / kabupaten
            $table->string('province', 100)->nullable(); // Provinsi opsional
            $table->string('phone', 30); // Nomor kontak cabang
            $table->string('email', 100)->nullable(); // Email opsional
            $table->string('logo_path', 255)->nullable(); // Path/Logo cabang
            $table->boolean('is_main')->default(false); // Apakah cabang utama
            $table->boolean('is_active')->default(true); // Status cabang
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branchess');
    }
};
