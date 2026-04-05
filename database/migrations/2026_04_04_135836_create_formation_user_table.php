<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete();
            $table->timestamp('enrolled_at')->nullable();
            $table->primary(['user_id', 'formation_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_user');
    }
};