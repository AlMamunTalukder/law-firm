<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('writer_designations', function (Blueprint $table) {
            $table->foreignId('writer_id')->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('designation_id')->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('writer_designations');
    }
};
