<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

use App\Models\User;

use App\Http\Requests\RegisterUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;

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
            'users' => User::where('role', 'staff')->get()->map(fn ($user) => [
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
    public function store(RegisterUserFormRequest $request)
    {
        $request_data = $request->validated();
        $request_data['password'] = Hash::make($request->validated()['password']);
        User::create($request_data);

        return redirect('/staffs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('App/Staffs/Edit', [
            'staff' => [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'contact_no' => $user->contact_no,
                'email' => $user->email,
                'username' => $user->username,
                'status' => $user->status,
                'role' => $user->role,
                'password' => '',
                'password_confirmation' => '',
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserFormRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect('/staffs');
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
