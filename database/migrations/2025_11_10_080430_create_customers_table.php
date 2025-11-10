<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->text('address')->nullable();
            $table->string('district', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('npwp', 30)->nullable();
            $table->string('npwp_name', 150)->nullable();
            $table->text('npwp_address')->nullable();
            $table->date('npwp_date')->nullable();
            $table->decimal('total_receivable', 14, 2)->default(0);
            $table->decimal('credit_limit', 14, 2)->default(0);

            // ✅ ENUM ini sudah mencakup jenis customer
            $table->enum('customer_type', ['retail', 'wholesale', 'vip', 'member'])->default('retail');
            $table->enum('wholesale_price_type', ['NORMAL', 'GROSIR1', 'GROSIR2', 'GROSIR3', 'GROSIR4'])->default('NORMAL');
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');
            $table->string('card_number', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
