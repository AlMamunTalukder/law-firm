<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('news_sections', function (Blueprint $table) {
            $table->foreignId('news_id')->nullable()
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('section_id')->nullable()
            ->constrained()
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_sections');
    }
};
