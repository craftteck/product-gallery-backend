<?php

use App\Http\Controllers\Product\CreateProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->name('product.')->group(function () {
    Route::post('', [CreateProductController::class, 'create'])->name('create');
});
