<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, "viewAll"]);
Route::get('/details/{id}', [ProductController::class, "details"]);
Route::get('/ajout/{id}', [ProductController::class, "ajout"]);


Route::get('/panier', [ProductController::class, "panier"]);

Route::get('/validation',[ProductController::class, "validation"]);

Route::get('/product/create', [ProductController::class, "create"]);

Route::put('/product/save', [ProductController::class, "save"]);

Route::get('/product/modify/{id}', [ProductController::class, "modify"]);

Route::put('/product/modify/{id}', [ProductController::class, "modifySave"]);


