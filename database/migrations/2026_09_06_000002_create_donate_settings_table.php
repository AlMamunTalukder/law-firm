<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donate_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default('Donate Us');
            $table->longText('description')->nullable()->comment('Intro text HTML from quill');
            $table->string('qr_image')->nullable()->comment('QR code image path');
            $table->timestamps();
        });
        // seed single row
        DB::table('donate_settings')->insert([
            'title' => 'Donate Us',
            'description' => '<p>Your donation helps us continue our activities. Scan the QR or use bank details below.</p>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('account_name')->nullable();
            $table->string('account_no');
            $table->string('branch')->nullable();
            $table->string('routing_no')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('donate_settings');
    }
};
