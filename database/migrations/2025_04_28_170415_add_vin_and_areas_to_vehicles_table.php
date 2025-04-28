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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('vin')->nullable()->after('order_number'); // VIN después del número de orden

            // Áreas del proceso, todos como booleanos, valores true/false
            $table->boolean('diagnostic')->default(false)->after('vin');
            $table->boolean('dismantling')->default(false);
            $table->boolean('disassembly')->default(false);
            $table->boolean('assembly')->default(false);
            $table->boolean('mounting')->default(false);
            $table->boolean('testing')->default(false);
            $table->boolean('delivered')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'vin',
                'diagnostic',
                'dismantling',
                'disassembly',
                'assembly',
                'mounting',
                'testing',
                'delivered',
            ]);
        });
    }
};
