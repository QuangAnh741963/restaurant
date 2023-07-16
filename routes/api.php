<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExtraItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/table/open', [TableController::class, 'getTableOpen']);
Route::get('/table/close', [TableController::class, 'getTableClose']);
Route::apiResource('/table', TableController::class);
Route::put('/table/updateOpen/{id}', [TableController::class, 'updateStateOpen']);
Route::put('/table/updateClose/{id}', [TableController::class, 'updateStateClose']);

Route::apiResource('/item', ItemController::class);

Route::apiResource('/extra_item', ExtraItemController::class);

Route::apiResource('/customer',CustomerController::class);

Route::apiResource('/restaurant',RestaurantController::class);
