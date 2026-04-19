<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('OwnBlog');
            $table->string('site_logo_path')->nullable();
            $table->string('connect_1_label')->nullable();
            $table->string('connect_1_url')->nullable();
            $table->string('connect_2_label')->nullable();
            $table->string('connect_2_url')->nullable();
            $table->string('connect_3_label')->nullable();
            $table->string('connect_3_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
