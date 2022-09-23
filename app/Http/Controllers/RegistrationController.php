<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;
use App\Models\Service;
use App\Models\Patient;

use App\Http\Requests\CheckPatientIdFormRequest;
use App\Http\Requests\QueuePatientFormRequest;
use Carbon\Carbon;
use Exception;

class RegistrationController extends Controller
{
    public function service()
    {
        // return view with services
        return Inertia::render('App/Registration/Service', [
            'services' => Service::all()->map(fn ($service) => [
                'id' => $service->id,
                'type' => $service->type,
            ])
        ]);
    }

    public function window($id)
    {
        // find service
        $service = Service::find($id);

        // return view with windows associated with the service data
        return Inertia::render('App/Registration/Window', [
            'service' => $service,
            'windows' => $service->windows->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
            ])
        ]);
    }

    public function register($id, $patient_id = null)
    {
        // find window
        $window = Window::find($id);

        // check for patient id
        if (!isset($patient_id)) {

            // return view with window and empty patient
            return Inertia::render('App/Registration/Register',  [
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
                ],
            ]);
        } else {
            // check for patient
            $patient = Patient::where('unique_id', $patient_id)->first();

            // return view with window and patient
            return Inertia::render('App/Registration/Register',  [
                'window' => [
                    'id' => $window->id,
                    'name' => $window->name,
                ],
                'patient' => [
                    'unique_id' => $patient->unique_id,
                    'fullname' => $patient->fullname,
                    'sex' => $patient->sex,
                    'birthdate' => $patient->birthdate,
                    'address' => $patient->address,
                    'contact_no' => $patient->contact_no,
                ],
            ]);
        }
    }

    public function check(CheckPatientIdFormRequest $request)
    {
        $request->validated();

        // find patient with request unique_id
        $patient = Patient::where('unique_id', $request['unique_id']);

        // if patient exists
        if ($patient->exists()) {

            // redirect to register with window and patient
            return redirect()->route('register', [
                'window' => $request['window_id'],
                'patient' => $request['unique_id'],
            ]);
        }

        // if not exists
        else {
            // return view with error message
            return redirect()->route('register', [
                'window' => $request['window_id'],
            ])
                ->with('message', 'Patient record not found')
                ->with('toast_type', 'error');
        }
    }

    public function queue(QueuePatientFormRequest $request)
    {
        // validate request
        $request->validated();

        // get patient registration data
        $patient_data = $request['patient'];

        // find active window
        $window = Window::find($request['window_id']);

        // set initial queue number to 1
        $number = 1;

        // get latest number from pivot
        try {
            $number = $window->latest_patients()->orderBy('pivot_number', 'desc')->first()->pivot->number;
            $number++;
        } catch (Exception $ex) {
            // number set back to 1
        }

        // empty data means patient has no existing record
        if (empty($request['patient']['unique_id'])) {

            // generate id and check for duplicates
            $generated_id = generateId();
            $exists = Patient::where('unique_id', $generated_id)->exists();
            while ($exists) {
                $generated_id = generateId();
                $exists = Patient::where('unique_id', generateId())->exists();
            }

            // set generated id to patient registration data
            $patient_data['unique_id'] = $generated_id;

            // create patient
            $patient = Patient::create($patient_data);
            // queue patient to requested window
            $patient->windows()->attach($request['window_id'], ['number' => $number]);

            return redirect()->route('message')
                ->with('window', $window->name)
                ->with('number', $number)
                ->with('unique_id', $patient->unique_id)
                ->with('fullname', $patient->fullname);
        }

        // patient has existing record
        else {
            // find patient
            $patient = Patient::where('unique_id', $patient_data['unique_id'])->first();
            // queue patient to requested window
            $patient->windows()->attach($request['window_id'], ['number' => $number]);

            // redirect
            return redirect()->route('message')
                ->with('window', $window->name)
                ->with('number', $number)
                ->with('fullname', $patient->fullname);
        }
    }

    public function message()
    {
        return Inertia::render('App/Registration/Message');
    }
}
