<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{

    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('code')->nullable();
            $table->string('url')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
