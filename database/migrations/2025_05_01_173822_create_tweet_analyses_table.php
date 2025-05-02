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
        Schema::create('tweet_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('tweet_id')->unique();
            $table->tinyInteger('impact_score');
            $table->string('sentiment');
            $table->json('coins')->nullable();
            $table->string('action');
            $table->timestamp('analyzed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweet_analyses');
    }
};
