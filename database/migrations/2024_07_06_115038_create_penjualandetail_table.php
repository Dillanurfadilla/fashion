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
        Schema::create('penjualandetail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id');
            $table->string('kode_fashion');
            $table->double('harga', 15, 2);
            $table->integer('qty');
            $table->double('subtotal', 15, 2);
            

            // Foreign key constraints
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('cascade');
            $table->foreign('kode_fashion')->references('kode_fashion')->on('fashion')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualandetail');
    }
};
