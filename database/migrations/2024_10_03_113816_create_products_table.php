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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('product_name'); // Product name
            $table->decimal('product_price', 10, 2); // Product price
            $table->integer('product_quantity'); // Product quantity
            $table->enum('product_type', ['flat', 'discount']); // Product type
            $table->string('discount')->nullable(); // Discount information
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
