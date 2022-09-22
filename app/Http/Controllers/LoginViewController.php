<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginViewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                return redirect('/');
            } else if (auth()->user()->role === 'staff') {
                return redirect('/dashboard/staff');
            }
        }
        return Inertia::render('Auth/Login');
    }
}
