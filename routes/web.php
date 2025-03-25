<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Admin-only routes
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::resource('users', UserController::class);
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);
    Route::post('customers/{customer}/assign', [CustomerController::class, 'assign'])->name('customers.assign');
    
    // Customer actions
    Route::resource('customers.actions', ActionController::class)->shallow();
    Route::post('customers/{customer}/actions/{action}/result', [ActionController::class, 'addResult'])->name('customers.actions.result');
});

require __DIR__.'/auth.php';
