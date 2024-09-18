<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_programing_language_tag', function (Blueprint $table) {
            $table->comment('プロダクト - プログラミング言語タグ');

            $table->id();
            $table->foreignId('product_id')->comment('プロダクトID')->constrained()->cascadeOnDelete();
            $table->foreignId('programing_language_tag_id')->comment('プログラミング言語タグID')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_programing_language_tag');
    }
};
