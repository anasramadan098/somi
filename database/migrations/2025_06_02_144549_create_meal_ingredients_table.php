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
        Schema::create('meal_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id')->constrained()->onDelete('cascade'); // ربط بالوجبة
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade'); // ربط بالمكون
            $table->decimal('quantity', 8, 2); // الكمية المطلوبة من المكون
            $table->string('notes')->nullable(); // ملاحظات إضافية
            $table->timestamps();

            // فهرس مركب لمنع التكرار
            $table->unique(['meal_id', 'ingredient_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_ingredients');
    }
};
