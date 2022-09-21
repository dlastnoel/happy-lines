<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WindowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceSelectController;
use App\Http\Controllers\WindowQueuePatientController;
use App\Http\Controllers\WindowCheckPatientController;
use App\Http\Controllers\WindowRegistrationController;
use App\Http\Controllers\WindowSelectController;

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

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})
    ->name('login');
// Route::post('/login', [LoginController::class, 'login']);


// Grouped with auth middleware
Route::middleware('auth')->group(function () {

    Route::get('/', DashboardController::class);

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
    Route::get('/staffs/{user}/edit', [UserController::class, 'edit']);
    Route::put('/staffs/{user}', [UserController::class, 'update']);

    // windows 
    Route::resource('windows', WindowController::class);

    // services
    Route::resource('services', ServiceController::class);
});


// client-side registration
Route::get('/register/regular', function () {
    return Inertia::render('App/Register/Regular');
});

Route::get('/register/priority', function () {
    return Inertia::render('App/Register/Priority');
});

Route::get('/serving', function () {
    return Inertia::render('App/Serving/Index');
});

// // client-side registration
// Route::get('/service/select', ServiceSelectController::class);
// Route::get('/window/{service}/select', WindowSelectController::class);
// Route::get('window/{window}/register', WindowRegistrationController::class);
// Route::post('/check', WindowCheckPatientController::class);
// Route::post('/queue/patient', WindowQueuePatientController::class);

Route::get('/service/select', [MenuController::class, 'index']);
Route::get('/window/{service}/select', [MenuController::class, 'show']);
Route::get('/register/{window}/{patient?}', [MenuController::class, 'register'])
    ->name('register');
Route::post('/check', [MenuController::class, 'check']);
Route::post('/queue/patient', [MenuController::class, 'queue']);
Route::get('/message', [MenuController::class, 'message']);

// queing monitor
Route::get('/queues', [QueueController::class, 'index']);
Route::get('/queues/{window}', [QueueController::class, 'show']);
