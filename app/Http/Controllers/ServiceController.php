<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Service;

use App\Http\Requests\CreateServiceFormRequest;
use App\Http\Requests\UpdateServiceFormRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('App/Services/Index', [
            'services' => Service::all()->map(fn ($service) => [
                'id' => $service->id,
                'type' => $service->type,
                'description' => $service->description,
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
        return Inertia::render('App/Services/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceFormRequest $request)
    {
        Service::create($request->validated());

        return redirect('/services');
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
    public function edit(Service $service)
    {
        return Inertia::render('App/Services/Edit', [
            'service' =>  [
                'id' => $service->id,
                'type' => $service->type,
                'description' => $service->description,
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
    public function update(UpdateServiceFormRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect('/services');
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
