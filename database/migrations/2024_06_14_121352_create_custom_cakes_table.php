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
        Schema::create('custom_cakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shape_id')->constrained('shapes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('flavor_id')->constrained('flavors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained('colors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('topping_id')->constrained('toppings')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('text')->nullable();
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_cakes');
    }
};
