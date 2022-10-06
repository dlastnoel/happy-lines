<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Http\Requests\RegisterDoctorFormRequest;
use App\Http\Requests\UpdateDoctorFormRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('App/Doctors/Index', [
            'auth' => getAuthUser(),
            'doctors' => User::where('role', 'doctor')->get()->map(fn ($doctor) => [
                'id' => $doctor->id,
                'fullname' => $doctor->firstname . ' ' . $doctor->lastname,
                'contact_no' => $doctor->contact_no,
                'email' => $doctor->email,
                'username' => $doctor->username,
                'status' => $doctor->status,
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
        return Inertia::render('App/Doctors/Register', [
            'auth' => getAuthUser(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterDoctorFormRequest $request)
    {
        $request_data = $request->validated();
        $request_data['password'] = Hash::make($request->validated()['password']);
        User::create($request_data);

        return redirect('/doctors');
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
    public function edit(User $doctor)
    {
        return Inertia::render('App/Doctors/Edit', [
            'auth' => getAuthUser(),
            'doctor' => [
                'id' => $doctor->id,
                'firstname' => $doctor->firstname,
                'lastname' => $doctor->lastname,
                'contact_no' => $doctor->contact_no,
                'email' => $doctor->email,
                'username' => $doctor->username,
                'status' => $doctor->status,
                'role' => $doctor->role,
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
    public function update(UpdateDoctorFormRequest $request, User $doctor)
    {
        $doctor->update($request->validated());
        return redirect('/doctors');
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
