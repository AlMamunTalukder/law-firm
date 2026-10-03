<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->Integer('order')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1=committee,2=authors/editors');
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
