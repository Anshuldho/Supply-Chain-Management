<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/products', [ProductController::class, 'index'])->name('products.index');
    Route::resource('products', ProductController::class);
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
//Route::post('/products', [ProductController::class, 'store'])->name('products.store');


require __DIR__.'/auth.php';


// For Login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// Other necessary routes like register, password reset, etc.



Auth::routes();
