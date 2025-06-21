<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('location')->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('last_login')->nullable();

            $table->index('email', 'idx_unique_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
