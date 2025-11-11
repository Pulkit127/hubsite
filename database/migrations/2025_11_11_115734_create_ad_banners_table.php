<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ad_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Banner title
            $table->string('image')->nullable(); // Image path (storage/ad-banners/)
            $table->string('link')->nullable();  // Redirect link (e.g. sponsor URL)
            $table->integer('position')->default(0); // where to show
            $table->boolean('is_active')->default(true); // active or not
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad_banners');
    }
};
