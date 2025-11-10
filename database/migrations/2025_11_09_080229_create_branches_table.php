<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique()->comment('Kode unik cabang, misal: BJ, GDG, TSM');
            $table->string('name', 100)->comment('Nama cabang, misal: Bejen, Gudang, Matesih');
            $table->text('address')->nullable()->comment('Alamat lengkap');
            $table->string('city', 100)->nullable()->comment('Kota / Kabupaten');
            $table->string('province', 100)->nullable()->comment('Provinsi');
            $table->string('phone', 30)->nullable()->comment('Nomor kontak cabang');
            $table->string('email', 100)->nullable()->comment('Email cabang');
            $table->string('logo_path', 255)->nullable()->comment('Path logo cabang');
            $table->boolean('is_main')->default(false)->comment('True jika cabang utama');
            $table->boolean('is_active')->default('1')->comment('Status cabang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
