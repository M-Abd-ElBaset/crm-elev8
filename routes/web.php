<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin and employee routes
Route::middleware(['auth'])->group(function () {
    // User/Employee management (admin only)
    Route::resource('users', UserController::class);
    
    // Customer management
    Route::resource('customers', CustomerController::class);
    Route::post('customers/{customer}/assign', [CustomerController::class, 'assign'])->name('customers.assign');
    
    // Customer actions
    Route::resource('customers.actions', ActionController::class)->shallow();
    Route::post('customers/{customer}/actions/{action}/result', [ActionController::class, 'addResult'])->name('customers.actions.result');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
