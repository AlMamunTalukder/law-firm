<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('top_title')->nullable();
            $table->string('bottom_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('photo')->nullable()->comment('thumb image will be created when upload the main photo addint thumb_');
            $table->longText('description')->nullable();

            $table->foreignId('division_id')->nullable()->comment('track divisionwise news')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('district_id')->nullable()->comment('track districtwise news')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('area_id')->nullable()->comment('track areawise news')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('user_id')->nullable()->comment('who write/post this')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('writer_id')->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->date('action_date')->nullable()->comment('to show the date&time in news feed');
            $table->integer('total_visit')->nullable();
            $table->integer('total_share')->nullable();
            $table->integer('total_print')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('show_in_home')->nullable()->comment('null=inactive;1=active');
            $table->boolean('status')->nullable()->default(1)->comment('null=inactive;1=active');

            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
