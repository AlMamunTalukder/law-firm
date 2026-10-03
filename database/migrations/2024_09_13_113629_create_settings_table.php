<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('copyright')->nullable();
            $table->string('short_name')->nullable();
            $table->string('title')->nullable()->comment('it will use next to favicon');
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('admin_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('scroll_top')->nullable();
            $table->string('favicon')->nullable();

            $table->integer('male_students')->nullable();
            $table->integer('female_students')->nullable();
            $table->integer('donors')->nullable();
            $table->integer('alumni')->nullable();
             $table->text('teachers')->nullable();
            $table->text('staffs')->nullable();
            $table->text('donate')->nullable();

            $table->string('notice_title')->nullable();
            $table->longText('notice')->nullable();
            $table->string('about_title')->nullable();
            $table->longText('about')->nullable();
            $table->string('about_center_image')->nullable();
            $table->string('about_image')->nullable();

             $table->string('footer_connect_image')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();

            $table->string('logo_background_color')->nullable();
            $table->string('logo_side_text_color')->nullable();

            $table->string('menu_border_top_color')->nullable();
            $table->string('menu_border_bottom_color')->nullable();
            $table->string('menu_background_color')->nullable();
            $table->string('menu_item_hover_background_color')->nullable();
            $table->string('menu_item_hover_text_color')->nullable();
            $table->string('submenu_background_color')->nullable();
            $table->string('submenu_arrow_background_color')->nullable();
            $table->string('submenu_item_hover_background_color')->nullable();
            $table->string('submenu_item_hover_text_color')->nullable();

            $table->string('footer_top_background_color')->nullable();
            $table->string('footer_body_background_color')->nullable();
            $table->string('footer_bottom_background_color')->nullable();
            $table->string('footer_text_color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
