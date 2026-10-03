<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->double('salary')->nullable()->default(0);
            $table->string('slug')->nullable();
            $table->string('phone_no')->nullable()->comment('comma separated');
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');
            $table->timestamps();
             $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
