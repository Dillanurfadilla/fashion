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
        Schema::create('fashion', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fashion',10)->unique();
            $table->string('nama_fashion',255);
            $table->double('harga');
            $table->string('photo',255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fashion');
    }
};
