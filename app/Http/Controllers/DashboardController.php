<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;

class DashboardController extends Controller
{
    //
    public function admin()
    {
        return Inertia::render('App/Dashboard/Admin', [
            'auth' => getAuthUser(),
        ]);
    }

    public function staff()
    {
        $window = auth()->user()->window;
        return Inertia::render('App/Dashboard/Staff', [
            'auth' => getAuthUser(),
            'window' => getAuthUserWindow(),
        ]);
    }
}
