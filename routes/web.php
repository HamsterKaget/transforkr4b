<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardJurusanController;
use App\Http\Controllers\DashboardKelasController;
use App\Http\Controllers\DashboardTechStackController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [HomeController::class, 'index'])   ;
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->name('dashboard.')->prefix('/dashboard')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');


    Route::name('master-kelas.')->prefix('/master-kelas')->group(function () {
        Route::get('/', [DashboardKelasController::class, 'index'])->name('index');
        Route::get('/getData', [DashboardKelasController::class, 'getData'])->name('getData');
        Route::post('/', [DashboardKelasController::class, 'store'])->name('create');
        Route::patch('/', [DashboardKelasController::class, 'update'])->name('update');
        Route::delete('/', [DashboardKelasController::class, 'delete'])->name('delete');
    });

    Route::name('master-jurusan.')->prefix('/master-jurusan')->group(function () {
        Route::get('/', [DashboardJurusanController::class, 'index'])->name('index');
        Route::get('/getData', [DashboardJurusanController::class, 'getData'])->name('getData');
        Route::post('/', [DashboardJurusanController::class, 'store'])->name('create');
        Route::patch('/', [DashboardJurusanController::class, 'update'])->name('update');
        Route::delete('/', [DashboardJurusanController::class, 'delete'])->name('delete');
    });

    Route::name('master-tech-stack.')->prefix('/master-tech-stack')->group(function () {
        Route::get('/', [DashboardTechStackController::class, 'index'])->name('index');
        Route::get('/getData', [DashboardTechStackController::class, 'getData'])->name('getData');
        Route::post('/', [DashboardTechStackController::class, 'store'])->name('create');
        Route::patch('/', [DashboardTechStackController::class, 'update'])->name('update');
        Route::delete('/', [DashboardTechStackController::class, 'delete'])->name('delete');
    });

    Route::name('master-user.')->prefix('/master-user')->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('index');
        Route::get('/getData', [DashboardUserController::class, 'getData'])->name('getData');
        Route::post('/', [DashboardUserController::class, 'store'])->name('create');
        Route::patch('/', [DashboardUserController::class, 'update'])->name('update');
        Route::delete('/', [DashboardUserController::class, 'delete'])->name('delete');
    });

});

require __DIR__.'/auth.php';
