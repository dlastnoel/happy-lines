<?php

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
    return Inertia::render('Auth/Login');
});

Route::get('/dashboard', function () {
    return Inertia::render('App/Dashboard');
});

Route::get('/records', function () {
    return Inertia::render('App/Records/Index');
});


// staffs
Route::get('/staffs', function () {
    return Inertia::render('App/Staffs/Index');
});

Route::get('/staffs/register', function () {
    return Inertia::render('App/Staffs/Register');
});


// windows 
Route::get('/windows', function () {
    return Inertia::render('App/Windows/Index');
});

Route::get('/windows/create', function () {
    return Inertia::render('App/Windows/Create');
});


// transactions
Route::get('/transactions', function () {
    return Inertia::render('App/Transactions/Index');
});

Route::get('/transactions/create', function () {
    return Inertia::render('App/Transactions/Create');
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
