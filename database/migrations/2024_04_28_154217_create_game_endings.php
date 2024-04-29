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
        Schema::create('game_endings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('intelligence');
            $table->integer('wealth');
            $table->integer('appearance');
            $table->integer('luck');
            $table->integer('morality');
            $table->integer('happiness');
            $table->json('achievements_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_endings');
    }
};
