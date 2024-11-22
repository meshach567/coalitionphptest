<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products/{product}/edit', [ProductController::class, 'update']);
Route::get('/products/data', [ProductController::class, 'getData']);
