<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->string('is_single_news')->nullable();
            $table->string('news_url')->nullable();
            $table->foreignId('category_id')->nullable()->comment('for submenu parent id will be placed here')
            ->constrained()
            ->onDelete('cascade');
            $table->tinyInteger('type')->nullable()->comment('1=News Category,2=Image & Video category');
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');
            $table->integer('order')->nullable();
            $table->string('photo')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
