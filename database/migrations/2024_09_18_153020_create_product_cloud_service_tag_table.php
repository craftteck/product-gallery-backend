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
        Schema::create('product_cloud_service_tag', function (Blueprint $table) {
            $table->comment('プロダクト - クラウドサービスタグ');

            $table->id();
            $table->foreignId('product_id')->comment('プロダクトID')->constrained()->cascadeOnDelete();
            $table->foreignId('cloud_service_tag_id')->comment('クラウドサービスタグID')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_cloud_service_tag');
    }
};
