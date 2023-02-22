<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/breeze', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/', [ProductController::class, "viewAll"]);

Route::get('/details/{id}', [ProductController::class, "details"]);

Route::get('/ajout/{id}', [ProductController::class, "ajout"]);


Route::get('/panier', [ProductController::class, "panier"]);

Route::get('/validation', [ProductController::class, "validation"]);

Route::middleware('admin')->group(function () {
    Route::get('/product/create', [ProductController::class, "create"]);

    Route::post('/product/save', [ProductController::class, "save"]);

    Route::get('/product/modify/{id}', [ProductController::class, "modify"]);

    Route::put('/product/save-modify/{id}', [ProductController::class, "saveModify"]);

    Route::delete(('/product/delete/{id}'), [ProductController::class, "delete"]);
});
