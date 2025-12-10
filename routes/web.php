<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('meals', MealController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/meals', MealController::class);
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.filter');
});

require __DIR__.'/auth.php';
