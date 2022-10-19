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
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MonitorController;

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


// Grouped with auth middleware
Route::middleware('auth')->group(function () {

    // dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'admin');
        Route::get('/dashboard/staff', 'staff');
        Route::get('/dashboard/doctor', 'doctor');
    });

    Route::get('/records', function () {
        return Inertia::render('App/Records/Index');
    });

    // staffs
    Route::controller(UserController::class)->group(function () {
        Route::get('/staffs', 'index');
        Route::post('/staffs', 'store');
        Route::get('/staffs/register', 'register');
        Route::get('/staffs/{user}/edit', 'edit');
        Route::put('/staffs/{user}', 'update');
    });

    // doctors
    Route::controller(DoctorController::class)->group(function () {
        Route::get('/doctors', 'index');
        Route::post('/doctors', 'store');
        Route::get('/doctors/register', 'register');
        Route::get('/doctors/{doctor}/edit', 'edit');
        Route::put('/doctors/{doctor}', 'update');
    });

    // windows 
    Route::resource('windows', WindowController::class);

    // services
    Route::resource('services', ServiceController::class);

    // staff window (queueing)
    Route::controller(QueueController::class)->group(function () {
        Route::get('/queues/{window}', 'serve')
            ->name('queue.serve');
        Route::get('/queues/{window}/diagnose', 'diagnose')
            ->name('queue.diagnose');
        Route::post('/queues/{window}', 'update');
        Route::get('/queues/{window}/{patient}/next', 'next');
        Route::get('/queues/{window}/{patient}/{next}/finish', 'finish');
    });
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

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/service/select', 'service');
    Route::get('/window/{service}/select', 'window');
    Route::get('/register/{window}/{patient?}', 'register')
        ->name('register');
    Route::post('/check', 'check');
    Route::post('/queue/patient', 'queue');
    Route::get('/message', 'message')
        ->name('message');
});

// queueieng monitor
// Route::get('/queues', [QueueController::class, 'index']);
Route::get('/queues/{window}/show', [QueueController::class, 'show']);

// monitor (for viewing queued patients)
Route::controller(MonitorController::class)->group(function () {

    // show windows
    Route::get('monitors', 'index');
    Route::get('monitors/window/{window}', 'view');
});
