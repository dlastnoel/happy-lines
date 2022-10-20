<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;
use App\Models\Result;

use App\Http\Requests\StoreResultFormRequest;

class QueueController extends Controller
{

    public function serve($id)
    {
        // find window
        $window = Window::find($id);

        // check if window user matches authenticated user
        if (auth()->user()->window->id === $window->id) {

            $patients = $window->pending_patients()->orderBy('pivot_number', 'asc')->get();
            $serving_patient = $window->serving_patient()->first();
            return Inertia::render('App/Queues/Serve', [
                'auth' => getAuthUser(),
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
                'next' => count($patients) > 0 ? $patients[0]->id : 0,
            ]);
        }
    }

    public function diagnose($id)
    {
        // find window
        $window = Window::find($id);

        // check if window user matches authenticated user
        if (auth()->user()->window->id === $window->id) {

            $patients = $window->pending_patients()->orderBy('pivot_number', 'asc')->get();
            $serving_patient = $window->serving_patient()->first();
            return Inertia::render('App/Queues/Diagnose', [
                'auth' => getAuthUser(),
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
                'next' => count($patients) > 0 ? $patients[0]->id : 0,
            ]);
        }
    }

    public function store(StoreResultFormRequest $request)
    {
        $request->validated();
        $window = Window::find($request->validated('window_id'));

        Result::create($request->validated());

        $window->serving_patient()->updateExistingPivot($request->validated('patient_id'), [
            'status' => 'done',
            'user_id' => auth()->user()->id,
        ]);

        $window->pending_patient($request->validated('next'))->updateExistingPivot($request->validated('next'), [
            'status' => 'serving',
        ]);

        return redirect()->route('queue.serve', [
            'window' => $request->validated('window_id'),
        ]);
    }

    public function next($window_id, $patient_id)
    {
        // find window
        $window = Window::find($window_id);

        // check if window user matches authenticated user
        if (auth()->user()->window->id === $window->id) {

            // update patient status move to pending
            $window->pending_patient($patient_id)->updateExistingPivot($patient_id, [
                'status' => 'serving',
            ]);
        }

        return redirect()->route('queue.serve', [
            'window' => $window_id,
        ]);
    }

    public function finish($window_id, $patient_id, $next)
    {
        // find window
        $window = Window::find($window_id);

        // check if window user matches authenticated user
        if (auth()->user()->window->id === $window->id) {

            // update patient status move to pending
            $window->serving_patient()->updateExistingPivot($patient_id, [
                'status' => 'done',
                'user_id' => auth()->user()->id,
            ]);

            $window->pending_patient($next)->updateExistingPivot($next, [
                'status' => 'serving',
            ]);
        }

        return redirect()->route('queue.serve', [
            'window' => $window_id,
        ]);
    }
}
