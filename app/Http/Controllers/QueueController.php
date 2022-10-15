<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;

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
            // dd($window->serving_patient()->first()->fullname);
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
