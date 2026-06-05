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
        Schema::create('venta_cabecera', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_venta')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('estado')->default('carrito');
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_cabecera');
    }
};
