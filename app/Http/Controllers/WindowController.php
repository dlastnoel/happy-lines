<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
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
            'windows' => Window::all()->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
                'description' => $window->description,
                // 'service' => $window->service->type
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
        $selected = Window::all()->pluck('transaction_id');
        $services = Service::query()->whereNotIn('id', $selected)->get();
        return Inertia::render('App/Windows/Create', [
            'services' => $services->map(fn ($service) => [
                'id' => $service->id,
                'type' => $service->type,
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
        Window::create($request->validated());

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
        $selected = Window::all()->pluck('transaction_id');
        $services = Service::query()->whereNotIn('id', $selected)->get();
        return Inertia::render('App/Windows/Edit', [
            'services' => $services,
            'window' => [
                'id' => $window->id,
                'name' => $window->name,
                'service_id' => $window->service_id,
                'service_type' => $window->service->type,
                'description' => $window->description,
                'is_active' => $window->is_active ? true : false,
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
        $window->update($request->validated());

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
