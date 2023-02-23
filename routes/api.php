<?php

use App\Http\Controllers\APIController;
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

Route::get('/products', [APIController::class, "products"]);
Route::get('/product/{id}', [APIController::class, "details"]);

Route::post('/login', [APIController::class, "login"]);
Route::get('/test', [APIController::class, 'test'])->middleware(('auth:sanctum'));

Route::post('/store', [APIController::class, "store"]);
