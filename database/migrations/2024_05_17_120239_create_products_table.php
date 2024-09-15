<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->comment('プロダクト');

            $table->id()->comment('ID');
            $table->foreignId('user_id')->comment('ユーザーID')->constrained()->cascadeOnDelete();
            $table->string('name')->comment('プロダクト名');
            $table->string('summary')->comment('プロダクト概要');
            $table->string('description')->comment('プロダクト説明');
            $table->string('url')->comment('プロダクトURL');
            $table->integer('version')->comment('バージョン');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
