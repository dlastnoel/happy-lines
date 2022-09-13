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

    public function show(Service $service)
    {
        return Inertia::render('App/Menu/Select', [
            'windows' => $service->windows->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
            ])
        ]);
    }
}
