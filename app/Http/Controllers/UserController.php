<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('App/Staffs/Index', [
            'users' => User::all()->map(fn ($user) => [
                'id' => $user->id,
                'fullname' => $user->firstname . ' ' . $user->lastname,
                'contact_no' => $user->contact_no,
                'email' => $user->email,
                'username' => $user->username,
                'status' => $user->status,
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return Inertia::render('App/Staffs/Register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create(
            $request->validate([
                'firstname' => ['required'],
                'lastname' => ['required'],
                'contact_no' => ['required', 'numeric', 'unique:users,contact_no'],
                'email' => ['required', 'unique:users,email'],
                'status' => ['required'],
                'username' => ['required', 'unique:users,username'],
                'role' => ['required'],
                'password' => ['required'],
            ])
        );

        return redirect('/staffs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
