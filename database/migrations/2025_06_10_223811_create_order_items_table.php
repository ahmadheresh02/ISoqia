<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 10, 2);

            $table->index('order_id', 'idx_orderitem_order');
            $table->index('product_id', 'idx_orderitem_product');
            $table->unique(['order_id', 'product_id'], 'idx_unique_order_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
