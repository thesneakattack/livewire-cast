<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Transactions\Transactions;
use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\SubCategories\SubCategories;
use App\Http\Livewire\Profile;

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

Route::redirect('/', 'transactions');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/categories', Categories::class)->name('categories');
    Route::get('/sub-categories', SubCategories::class)->name('sub-categories');
    Route::get('/profile', Profile::class)->name('profile');
});

/**
 * App Routes
 */
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', Dashboard::class)->name('dashboard');
//     Route::get('/profile', Profile::class);
// });

/**
 * Authentication
 */
// Route::middleware('guest')->group(function () {
//     Route::get('/login', Login::class)->name('auth.login');
//     Route::get('/register', Register::class)->name('auth.register');
// });
