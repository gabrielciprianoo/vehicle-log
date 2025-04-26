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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('vehicle');
            $table->string('color');
            $table->string('plates');
            $table->string('service_type');
            $table->string('order_number');
            $table->boolean('yellow_sheet')->default(false);
            $table->boolean('blue_sheet')->default(false);
            $table->boolean('history')->default(false);
            $table->boolean('gas')->default(false);
            $table->boolean('plas')->default(false);
            $table->boolean('km')->default(false);
            $table->boolean('key')->default(false);
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
