<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;

class MonitorController extends Controller
{
    public function index()
    {

        // return view with all active windows
        return Inertia::render('App/Monitors/Index', [
            'windows' => Window::where('is_active', true)->get()->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
                'staff' => $window->user->fullname(),
            ]),
        ]);
    }

    public function view($id)
    {
        // find active window
        $window = Window::find($id);

        // extract pending patients from the active window
        $patients = $window->pending_patients()->orderBy('pivot_number', 'asc')->get();
        $serving_patient = $window->serving_patient()->first();

        return Inertia::render('App/Monitors/View', [
            'window' => [
                'name' => $window->name,
            ],
            'patients' => $patients->map(fn ($patient) => [
                'id' => $patient->id,
                'number' => $patient->pivot->number,
                'fullname' => $patient->fullname
            ]),
            'window' => getAuthUserWindow(),
            'patients' => $patients->map(fn ($patient) => [
                'id' => $patient->id,
                'number' => $patient->pivot->number,
                'fullname' => $patient->fullname,
            ]),
            'serving_patient' => $window->serving_patient()->count() > 0 ? [
                'id' => $serving_patient->id,
                'number' => $serving_patient->pivot->number,
                'fullname' => $serving_patient->fullname,
                'sex' => $serving_patient->sex,
            ] : '0',
        ]);
    }
}
