<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamp('added_at')->useCurrent();

            $table->index('cart_id', 'idx_cart_item_cart');
            $table->index('product_id', 'idx_cart_item_product');
            $table->unique(['cart_id', 'product_id'], 'idx_unique_cart_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
