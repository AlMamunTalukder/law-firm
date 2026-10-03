<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('home page different section name ex:box,');
            $table->string('route_name')->nullable()->comment('to check the section name/for checking purpose');
            $table->tinyInteger('type')->nullable()->comment('1=News;2=Category,3=Footer Blocks,4=Ads Block positions');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
