<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image_url');
            $table->integer('sort_order')->default(1);
            
            $table->index('product_id', 'idx_image_product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};