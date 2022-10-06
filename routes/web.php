<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WindowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginViewController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\StaffWindowController;
use App\Http\Controllers\DoctorController;

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

Route::get('/login', LoginViewController::class)
    ->name('login');
// Route::get('/login', function () {
//     return Inertia::render('Auth/Login');
// })
//     ->name('login');
// Route::post('/login', [LoginController::class, 'login']);


// Grouped with auth middleware
Route::middleware('auth')->group(function () {

    // dashboard
    Route::get('/', [DashboardController::class, 'admin']);
    Route::get('/dashboard/staff', [DashboardController::class, 'staff']);

    Route::get('/records', function () {
        return Inertia::render('App/Records/Index');
    });

    // staffs
    Route::get('/staffs', [UserController::class, 'index']);
    Route::post('/staffs', [UserController::class, 'store']);
    Route::get('/staffs/register', [UserController::class, 'register']);
    Route::get('/staffs/{user}/edit', [UserController::class, 'edit']);
    Route::put('/staffs/{user}', [UserController::class, 'update']);

    // doctors
    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::post('/doctors', [DoctorController::class, 'store']);
    Route::get('/doctors/register', [DoctorController::class, 'register']);
    Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit']);
    Route::put('/doctors/{doctor}', [DoctorController::class, 'update']);

    // windows 
    Route::resource('windows', WindowController::class);

    // services
    Route::resource('services', ServiceController::class);

    // staff window (queueing)
    Route::get('/queues/{window}', [QueueController::class, 'serve'])
        ->name('queue.serve');
    Route::post('/queues/{window}', [QueueController::class, 'update']);
    Route::get('/queues/{window}/{patient}/next', [QueueController::class, 'next']);
    Route::get('/queues/{window}/{patient}/{next}/finish', [QueueController::class, 'finish']);
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

Route::get('/service/select', [RegistrationController::class, 'service']);
Route::get('/window/{service}/select', [RegistrationController::class, 'window']);
Route::get('/register/{window}/{patient?}', [RegistrationController::class, 'register'])
    ->name('register');
Route::post('/check', [RegistrationController::class, 'check']);
Route::post('/queue/patient', [RegistrationController::class, 'queue']);
Route::get('/message', [RegistrationController::class, 'message'])
    ->name('message');

// queing monitor
Route::get('/queues', [QueueController::class, 'index']);
Route::get('/queues/{window}/show', [QueueController::class, 'show']);
