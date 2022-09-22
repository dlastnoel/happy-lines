<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Window;
use App\Models\Service;
use App\Models\Patient;

use App\Http\Requests\CheckPatientIdFormRequest;
use App\Http\Requests\QueuePatientFormRequest;

class MenuController extends Controller
{
    public function service()
    {
        return Inertia::render('App/Menu/Service', [
            'services' => Service::all()->map(fn ($service) => [
                'id' => $service->id,
                'type' => $service->type,
            ])
        ]);
    }

    public function window($id)
    {
        $service = Service::find($id);
        return Inertia::render('App/Menu/Window', [
            'service' => $service,
            'windows' => $service->windows->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
            ])
        ]);
    }

    public function register($id, $patient_id = null)
    {
        $window = Window::find($id);
        if (!isset($patient_id)) {
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
                ],
            ]);
        } else {
            $patient = Patient::where('unique_id', $patient_id)->first();
            return Inertia::render('App/Menu/Registration',  [
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
        $patient = Patient::where('unique_id', $request['unique_id']);
        if ($patient->exists()) {
            return redirect()->route('register', [
                'window' => $request['window_id'],
                'patient' => $request['unique_id'],
            ]);
        } else {
            return redirect()->route('register', [
                'window' => $request['window_id'],
            ])
                ->with('message', 'Patient record not found')
                ->with('toast_type', 'error');
        }
    }

    public function queue(QueuePatientFormRequest $request)
    {
        $request->validated();
        if (empty($request['patient']['unique_id'])) {
            $patient_data = $request['patient'];
            $generated_id = generateId();
            $exists = Patient::where('unique_id', $generated_id)->exists();
            while ($exists) {
                $generated_id = generateId();
                $exists = Patient::where('unique_id', generateId())->exists();
            }
            $patient_data['unique_id'] = $generated_id;
            $patient = Patient::create($patient_data);
            $patient->windows()->attach($request['window_id']);

            return redirect('/message');
        } else {
            $patient_data = $request['patient'];
            $patient = Patient::where('unique_id', $patient_data['unique_id'])->first();
            $patient->windows()->attach($request['window_id']);

            return redirect('/message');
        }
    }

    public function message()
    {
        return Inertia::render('App/Menu/Message');
    }
}
