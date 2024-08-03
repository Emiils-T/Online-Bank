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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->string('type');
            $table->string('name')->nullable();
            $table->decimal('price');
            $table->decimal('1h_change')->nullable();
            $table->decimal('12h_change')->nullable();
            $table->decimal('24h_change')->nullable();
            $table->decimal('7d_change')->nullable();
            $table->decimal('market_cap')->nullable();
            $table->timestamps();

            $table->unique(['symbol', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
