<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('photo')->nullable()->comment('for video use as thumnail');
            $table->text('link')->nullable()->comment('basic used for video; for image external link');
            $table->tinyInteger('type')->nullable()->comment('1=image;2=video');
            $table->boolean('is_show_in_home')->nullable()->comment('1=show in home page according to order');
            $table->boolean('is_home_slider_sticky')->nullable('1=show in home page on above of slider');
            $table->boolean('is_featured')->nullable()->comment('1=show in category page slider for image or fatured video');
            $table->tinyInteger('video_type')->nullable()->comment('1=youtube;2=dailymotion;3=uploaded');
             $table->Integer('total_view')->default(0)->nullable();
            $table->Integer('order')->nullable();
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
