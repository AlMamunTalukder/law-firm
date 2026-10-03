<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('image_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()
            ->constrained()
            ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('link')->nullable()->comment('for video youtube link');
            $table->string('photo')->nullable();
            $table->boolean('sticky')->nullable()->comment('Home page big sticky video');
            $table->boolean('block')->nullable()->comment('Home page under big sticky video block');
            $table->boolean('sticky_image')->nullable()->comment('Home page big sticky image');
            $table->boolean('block_image')->nullable()->comment('Home page under big sticky block image');
            $table->boolean('important')->nullable()->comment('its for main page sticky. slider for image and video for at the top');
            $table->tinyInteger('type')->nullable()->comment('1=image;2=video');
            $table->tinyInteger('video_type')->nullable()->comment('1=uploaded;2=youtube');
            $table->Integer('total_view')->default(0)->nullable();
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_videos');
    }
};
