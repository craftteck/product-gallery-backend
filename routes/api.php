<?php

use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\ReadProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('', [CreateProductController::class, 'create']);
        Route::get('{id}', [ReadProductController::class, 'read'])->whereNumber('id');
        Route::delete('', [DeleteProductController::class, 'delete']);
    });
