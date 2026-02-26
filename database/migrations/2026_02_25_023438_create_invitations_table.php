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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('template_id')->constrained();
            $table->string('slug')->unique();
            $table->json('data_mempelai')->nullable();
            $table->json('data_acara')->nullable();
            $table->json('data_fitur_tambahan')->nullable();
            $table->foreignId('music_id')->nullable()->constrained('music')->nullOnDelete();
            $table->json('data_galeri')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
