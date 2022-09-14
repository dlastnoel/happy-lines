<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;

class QueueController extends Controller
{
    public function index()
    {
        return Inertia::render('App/Queues/Index', [
            'windows' => Window::where('is_active', true)->get()->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
                'staff' => $window->user->fullname(),
            ]),
        ]);
    }
}
