<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/catalog', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/carts/{id}', [CartController::class, 'show']);