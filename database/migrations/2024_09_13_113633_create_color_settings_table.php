<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('color_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('hover_bg_color')->nullable();
            $table->string('hover_text_color')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1=Menu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('color_settings');
    }
};
