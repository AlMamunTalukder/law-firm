<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{

    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('url')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
