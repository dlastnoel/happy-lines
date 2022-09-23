<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;

class QueueController extends Controller
{
    public function index()
    {
        // return view with all active windows
        return Inertia::render('App/Queues/Index', [
            'windows' => Window::where('is_active', true)->get()->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
                'staff' => $window->user->fullname(),
            ]),
        ]);
    }

    public function serve($id)
    {
        // find window
        $window = Window::find($id);

        // check if window user matches authenticated user
        if (auth()->user()->window->id === $window->id) {

            $patients = $window->latest_patients()->orderBy('pivot_number', 'asc')->get();
            return Inertia::render('App/Queues/Serve', [
                'auth' => getAuthUser(),
                'window' => getAuthUserWindow(),
                'patients' => $patients->map(fn ($patient) => [
                    'id' => $patient->id,
                    'number' => $patient->pivot->number,
                    'fullname' => $patient->fullname,
                    'sex' => $patient->sex,
                ])
            ]);
        }
    }

    public function next($window_id, $patient_id)
    {
        // find window
        $window = Window::find($window_id);
        // check if window user matches authenticated user
        if (auth()->user()->window->id === $window->id) {
            // dd($patient->with('windows')->where('id', $window_id)->get());
            dd($window->window_patient($patient_id)->first()->pivot->status);
        }
    }
}
