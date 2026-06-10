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
        Schema::table('venta_cabecera', function (Blueprint $table) {
            $table->string('numero_pedido', 30)->nullable()->unique()->after('total');
            // Datos de facturación
            $table->string('nombre_cliente', 50)->nullable()->after('numero_pedido');
            $table->string('apellido_cliente', 50)->nullable()->after('nombre_cliente');
            $table->string('email_cliente', 100)->nullable()->after('apellido_cliente');
            $table->string('telefono_cliente', 20)->nullable()->after('email_cliente');
            // Envío
            $table->string('tipo_envio', 20)->nullable()->after('telefono_cliente');  // retiro / domicilio
            $table->string('transporte', 40)->nullable()->after('tipo_envio');
            $table->string('provincia', 60)->nullable()->after('transporte');
            $table->string('localidad', 80)->nullable()->after('provincia');
            $table->string('calle', 120)->nullable()->after('localidad');
            $table->string('codigo_postal', 10)->nullable()->after('calle');
            $table->decimal('costo_envio', 10, 2)->default(0)->after('codigo_postal');
            // Pago
            $table->string('metodo_pago', 20)->nullable()->after('costo_envio');  // tarjeta / transferencia
        });
    }

    public function down(): void
    {
        Schema::table('venta_cabecera', function (Blueprint $table) {
            $table->dropColumn([
                'numero_pedido', 'nombre_cliente', 'apellido_cliente', 'email_cliente',
                'telefono_cliente', 'tipo_envio', 'transporte', 'provincia', 'localidad',
                'calle', 'codigo_postal', 'costo_envio', 'metodo_pago',
            ]);
        });
    }
};
