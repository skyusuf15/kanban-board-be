<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\DownloadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('column', [ColumnController::class, 'index']);
Route::post('column', [ColumnController::class, 'store']);
Route::delete('column/{id}', [ColumnController::class, 'destroy']);

Route::post('card', [CardController::class, 'store']);
Route::put('card/{id}', [CardController::class, 'update']);
Route::put('update/all_data', [CardController::class, 'updateCardsColumn']);

Route::get('download/query', [DownloadController::class, 'index']);
