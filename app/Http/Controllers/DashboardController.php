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
        if (auth()->user()->role === 'admin') {
            return Inertia::render('App/Dashboard/Admin', [
                'auth' => getAuthUser(),
            ]);
        } else if (auth()->user()->role === 'staff') {
            return redirect('/dashboard/staff');
        } else {
            return redirect('/dashboard/doctor');
        }
    }

    public function staff()
    {
        // staff dashboard
        if (auth()->user()->role === 'staff')
            return Inertia::render('App/Dashboard/User', [
                'auth' => getAuthUser(),
                'window' => getAuthUserWindow(),
            ]);
    }

    public function doctor()
    {
        // doctor dashboard
        if (auth()->user()->role === 'doctor')
            return Inertia::render('App/Dashboard/Doctor', [
                'auth' => getAuthUser(),
                'window' => getAuthUserWindow(),
            ]);
    }
}
