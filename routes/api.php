<?php

use App\Http\Controllers\Product\CreateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')
    ->name('product.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('', [CreateProductController::class, 'create'])->name('create');
    });
