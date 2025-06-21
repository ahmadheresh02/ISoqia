<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->text('description');
            $table->string('phone')->nullable();
            $table->string('package')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamp('read_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->index('is_visible', 'idx_contact_visible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};