<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('prayer_timers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->time('timing')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1=main prayer time;2=other timing');
            $table->tinyInteger('order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prayer_timers');
    }
};
