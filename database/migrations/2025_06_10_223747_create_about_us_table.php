<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('About Us');
            $table->text('content');
            $table->string('image_url')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');

            $table->index('updated_by', 'idx_about_updated_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
