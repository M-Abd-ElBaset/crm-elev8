<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Action;
use App\Models\Customer;
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


Route::middleware('auth')->group(function () {
    // Admin-only routes
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::get('/dashboard', function () {
        $customerCount = Customer::count();
        $actionCount = Action::count();
        $recentActions = Action::with(['customer', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $recentCustomers = Customer::with(['creator', 'assignedEmployee'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    
        return view('dashboard', compact('customerCount', 'actionCount', 'recentActions', 'recentCustomers'));
    })->middleware(['verified'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);
    Route::post('customers/{customer}/assign', [CustomerController::class, 'assign'])->name('customers.assign');
    
    // Customer actions
    Route::resource('customers.actions', ActionController::class);
    Route::post('customers/{customer}/actions/{action}/result', [ActionController::class, 'addResult'])->name('customers.actions.add-result');
});

require __DIR__.'/auth.php';
