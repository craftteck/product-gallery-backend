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
        Schema::create('product_category_tag', function (Blueprint $table) {
            $table->comment('プロダクト - プロダクトカテゴリタグ');

            $table->id();
            $table->foreignId('product_id')->comment('プロダクトID')->constrained()->cascadeOnDelete();
            $table->foreignId('product_category_tag_id')->comment('プロダクトカテゴリタグID')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_tag');
    }
};
