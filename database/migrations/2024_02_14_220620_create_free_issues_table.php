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
        Schema::create('free_issues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['flat', 'multiple']);
            $table->foreignId('purchase_product')->constrained('products');
            $table->foreignId('free_product')->constrained('products');
            $table->integer('purchase_quantity');
            $table->integer('free_quantity');
            $table->integer('lower_limit');
            $table->integer('upper_limit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_issues');
    }
};
