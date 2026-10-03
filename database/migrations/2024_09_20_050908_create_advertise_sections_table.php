<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('advertise_sections', function (Blueprint $table) {
            $table->foreignId('advertise_id')->nullable()
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
        Schema::dropIfExists('advertise_sections');
    }
};
