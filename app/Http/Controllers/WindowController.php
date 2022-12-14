<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Window;
use App\Models\Service;

use App\Http\Requests\CreateWindowFormRequest;
use App\Http\Requests\UpdateWindowFormRequest;

class WindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('App/Windows/Index', [
            'auth' => getAuthUser(),
            'windows' => Window::all()->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
                'description' => $window->description,
                'is_active' => $window->is_active === 1 ? true : false,
                'user' => $window->user->role === 'staff' ?
                    'User: ' . $window->user->fullname() :
                    'Doctor: ' . $window->user->fullname(),
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all services
        $services = Service::all();
        // get all users in all windows
        $tellers = Window::all()->pluck('user_id');
        // get all users that do not have a window
        $users = User::query()->whereNotIn('id', $tellers)->get();

        // $doctors = [];

        // foreach ($users as $user) {
        //     if ($user->role === 'doctor') {
        //         array_push($doctors, [
        //             'id' => $user->id,
        //             'fullname' => $user->fullname(),
        //             'selected' => false,
        //         ]);
        //     }
        // }

        // return view
        return Inertia::render('App/Windows/Create', [
            'auth' => getAuthUser(),
            'users' => $users->map(fn ($user) => [
                'id' => $user->id,
                'fullname' => $user->fullname(),
                'role' => $user->role,
                'selected' => false,
            ]),
            'services' => $services->map(fn ($service) => [
                'id' => $service->id,
                'type' => $service->type,
                'selected' => false,
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWindowFormRequest $request)
    {
        $request->validated();
        $window_data = $request->only('name', 'description', 'user_id', 'is_active', 'has_doctor');
        $services = $request->only('services');
        $window = Window::create($window_data);
        foreach ($services as $service) {
            $window->services()->attach($service);
        }


        return redirect('/windows');
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
    public function edit(Window $window)
    {
        $users = User::all();

        $services = Service::all()->map(fn ($service) => [
            'auth' => getAuthUser(),
            'id' => $service->id,
            'type' => $service->type,
            'selected' => false,
        ]);

        $service_data = [];

        foreach ($services as $service) {
            foreach ($window->services as $window_service) {
                if ($service['id'] === $window_service->id) {
                    $service['selected'] = true;
                }
            }
            array_push($service_data, $service);
        }

        return Inertia::render('App/Windows/Edit', [
            'auth' => getAuthUser(),
            'users' => $users->map(fn ($user) => [
                'id' => $user->id,
                'fullname' => $user->fullname(),
                'role' => $user->role,
                'selected' => $window->user_id === $user->id ? true : false,
            ]),
            'services' => $service_data,
            'window' => [
                'id' => $window->id,
                'name' => $window->name,
                'description' => $window->description,
                'user_id' => $window->user_id,
                'services' => $window->services->pluck('id'),
                'is_active' => $window->is_active === 1 ? true : false,
                'has_doctor' => $window->has_doctor,
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
    public function update(UpdateWindowFormRequest $request, Window $window)
    {
        $request->validated();
        $window->update($request->only('name', 'description', 'user_id', 'is_active'));
        $services = $request->only('services');
        foreach ($services as $service) {
            $window->services()->sync($service);
        }

        return redirect('/windows');
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
