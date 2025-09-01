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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('base', 3); // например, USD
            $table->string('code', 3); // валюта назначения, напр. EUR
            $table->decimal('rate', 20, 8); // сколько 1 base стоит в code? (или наоборот)
            $table->timestamp('fetched_at');
            $table->timestamps();
            $table->unique(['base', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
