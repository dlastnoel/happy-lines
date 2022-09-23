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
        // check authenticated user
        if (auth()->check()) {

            // if admin
            if (auth()->user()->role === 'admin') {
                return redirect('/');
            }

            // if staff
            else if (auth()->user()->role === 'staff') {
                return redirect('/dashboard/staff');
            }
        }
        return Inertia::render('Auth/Login');
    }
}
