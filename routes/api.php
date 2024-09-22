<?php

use App\Http\Controllers\Favorite\CreateFavoriteController;
use App\Http\Controllers\Favorite\DeleteFavoriteController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\ReadProductController;
use App\Http\Controllers\Product\UpdateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('', [CreateProductController::class, 'create']);
        Route::put('{id}', [UpdateProductController::class, 'update'])->whereNumber('id');
        Route::get('{id}', [ReadProductController::class, 'read'])->whereNumber('id');
        Route::delete('', [DeleteProductController::class, 'delete']);
    });

Route::prefix('favorites')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('', [CreateFavoriteController::class, 'create']);
        Route::delete('', [DeleteFavoriteController::class, 'delete']);
    });
