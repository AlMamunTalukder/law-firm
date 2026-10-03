<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('votings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('question');
            $table->string('option1')->nullable()->comment('answer option string');
            $table->string('option2')->nullable()->comment('answer option2 string');
            $table->string('option3')->nullable()->comment('answer option3 string');
            $table->date('action_date')->nullable();
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votings');
    }
};
