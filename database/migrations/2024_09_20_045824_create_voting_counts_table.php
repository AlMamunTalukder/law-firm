<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('voting_counts', function (Blueprint $table) {
            $table->foreignId('voting_id')->nullable()
            ->constrained()
            ->onDelete('cascade');
            $table->integer('option1_answer')->nullable()->comment('number of vote this option');
            $table->integer('option2_answer')->nullable()->comment('number of vote this option');
            $table->integer('option3_answer')->nullable()->comment('number of vote this option');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voting_counts');
    }
};
