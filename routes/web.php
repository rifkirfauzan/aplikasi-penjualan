<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FilterStockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('/stock')->group(function () {
    Route::get('/', [StockController::class, 'index']);
    Route::get('/create', [StockController::class, 'create']);
    Route::post('/', [StockController::class, 'store']);
    Route::get('/edit/{id}', [StockController::class, 'edit']);
    Route::patch('/{id}', [StockController::class, 'update']);
    Route::delete('/{id}', [StockController::class, 'destroy']);
});


Route::prefix('/filter')->group(function () {
    Route::get('/', [FilterStockController::class, 'index']);
});

Route::prefix('/transaction')->group(function () {
    Route::get('/', [TransactionController::class, 'index']);
    Route::get('/create', [TransactionController::class, 'create']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::get('/edit/{id}', [TransactionController::class, 'edit']);
    Route::patch('/{id}', [TransactionController::class, 'update']);
    Route::delete('/{id}', [TransactionController::class, 'destroy']);
});