<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->foreignId('section_id')->nullable()
            ->constrained()
            ->onDelete('cascade');
            $table->longText('name')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('type')->nullable()->default(1)->comment('1=link based;2=description based');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
