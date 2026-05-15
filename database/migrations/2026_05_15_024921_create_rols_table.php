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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // PK autoincremental [cite: 87, 89]
            $table->string('nombre')->unique(); // unique() evita roles duplicados [cite: 88, 90]
            $table->string('descripcion')->nullable(); // campo opcional [cite: 91]
            $table->timestamps(); // created_at y updated_at (automáticos) [cite: 92, 95]
            $table->softDeletes(); // borrado lógico [cite: 93, 95]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};
