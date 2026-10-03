<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('bottom_carousel_title')->nullable();
            $table->string('right_widget_color')->nullable();
            $table->string('right_widget_title_bgcolor')->nullable();
            $table->string('right_widget_bgcolor')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('bottom_carousel_title');
            $table->dropColumn('bottom_carouright_widget_colorsel_title');
            $table->dropColumn('right_widget_title_bgcolor');
            $table->dropColumn('right_widget_bgcolor');
        });
    }
};
