<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('category_tags', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('tag_id')->nullable()
            ->constrained()
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_tags');
    }
};
