<?php

use App\Http\Controllers\DatasetsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
  ]);
});

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/datasets', [DatasetsController::class, 'index'])->middleware(['auth', 'verified'])->name('datasets.index');

Route::get('/datasets/{dataset}', [DatasetsController::class, 'show'])->middleware(['auth', 'verified'])->name('datasets.show');

Route::get('/visualisations', function () {
  return Inertia::render('Visualisations/Index');
})->middleware(['auth', 'verified'])->name('visualisations.index');

Route::get('/visualisations/create', function () {
  return Inertia::render('Visualisations/Create');
})->middleware(['auth', 'verified'])->name('visualisations.create');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
