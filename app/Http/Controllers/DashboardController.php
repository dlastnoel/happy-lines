<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;

class DashboardController extends Controller
{

    public function admin()
    {
        // admin dashboard
        return Inertia::render('App/Dashboard/Admin', [
            'auth' => getAuthUser(),
        ]);
    }

    public function staff()
    {
        // staff dashboard
        return Inertia::render('App/Dashboard/Staff', [
            'auth' => getAuthUser(),
            'window' => getAuthUserWindow(),
        ]);
    }

    // public function doctor()
    // {
    //     // doctor dashboard
    //     return Inertia::render('App/Dashboard/Doctor', [
    //         'auth' => getAuthUser(),
    //         'window' => getAuthUserWindow(),
    //     ]);
    // }
}
