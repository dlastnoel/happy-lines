<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WindowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login']);


// group with authentication
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('App/Dashboard');
    })->name('dashboard');

    Route::get('/records', function () {
        return Inertia::render('App/Records/Index');
    });

    // staffs
    Route::get('/staffs', [UserController::class, 'index']);
    Route::post('/staffs', [UserController::class, 'store']);
    Route::get('/staffs/register', [UserController::class, 'register']);
    Route::get('/staffs/register', function () {
        return Inertia::render('App/Staffs/Register');
    });

    // windows 
    Route::resource('windows', WindowController::class);

    // transactions
    Route::resource('transactions', TransactionController::class);
});


// client-side registration
Route::get('register/regular', function () {
    return Inertia::render('App/Register/Regular');
});

Route::get('/register/priority', function () {
    return Inertia::render('App/Register/Priority');
});


Route::get('/serving/', function () {
    return Inertia::render('App/Serving/Index');
});
