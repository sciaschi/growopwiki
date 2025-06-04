<?php

use App\Http\Controllers\Plants\PlantsController;
use App\Http\Controllers\Plants\Populate\PopulatePlantsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::controller(PlantsController::class)->prefix('plants')->name('plants.')->group(function() {
    Route::get('/', 'index')->name('index');

    Route::get('/{slug}', 'details')->name('details');
});

Route::controller(PopulatePlantsController::class)->group(function() {
    Route::get('/populate-plants', 'populate');
    Route::get('/process-plants-json', 'processJson');
    Route::get('/exportToCSV', 'exportToCSV');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
