<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;
use App\Models\Service;

class MenuController extends Controller
{
    public function index()
    {
        return Inertia::render('App/Menu/Index', [
            'services' => Service::all()->map(fn ($service) => [
                'id' => $service->id,
                'type' => $service->type,
            ])
        ]);
    }

    public function show($id)
    {
        $service = Service::find($id);
        return Inertia::render('App/Menu/Select', [
            'service' => $service,
            'windows' => $service->windows->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
            ])
        ]);
    }

    public function register($id)
    {
        $window = Window::find($id);
        return Inertia::render('App/Menu/Registration',  [
            'window' => [
                'id' => $window->id,
                'name' => $window->name,
            ],
            'patient' => [
                'unique_id' => '',
                'fullname' => '',
                'sex' => '',
                'birthdate' => '',
                'address' => '',
                'contact_no' => '',
            ]
        ]);
    }

    public function queue(Request $request)
    {
    }
}
