<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{

    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('code')->nullable();
            $table->string('url')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
