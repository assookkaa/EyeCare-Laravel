<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkups = Appointment::where('appointments.status', '=', 'toCheckup')
            ->select('users.id as user', 'users.firstname', 'users.lastname', 'users.gender', 'appointments.custom_id', 'appointments.id',  'appointments.patient_id', 'appointments.time', 'appointments.date', 'appointments.status', 'appointments.note')
            ->join('users', 'users.custom_id', '=', 'appointments.patient_id')
            ->get();

        return view('layouts.checkup', compact('checkups'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function wstore(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => ['required', 'string', 'max:255', Rule::exists('users', 'custom_id')],
            'os_sph' => ['nullable', 'string', 'max:255'],
            'os_cyl' => ['nullable', 'string', 'max:255'],
            'os_axis' => ['nullable', 'string', 'max:255'],
            'od_sph' => ['nullable', 'string', 'max:255'],
            'od_cyl' => ['nullable', 'string', 'max:255'],
            'od_axis' => ['nullable', 'string', 'max:255'],
            'add' => ['nullable', 'string', 'max:255'],
            'pd' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $checkup = Checkup::create([
            'patient_id' => $validatedData['patient_id'],
            'os_sph' => $validatedData['os_sph'],
            'os_cyl' => $validatedData['os_cyl'],
            'os_axis' => $validatedData['os_axis'],
            'od_sph' => $validatedData['od_sph'],
            'od_cyl' => $validatedData['od_cyl'],
            'od_axis' => $validatedData['od_axis'],
            'add' => $validatedData['add'],
            'pd' => $validatedData['pd'],
            'note' => $validatedData['note'],
        ]);

        return redirect()->route('records');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => ['required', 'string', 'max:255', Rule::exists('users', 'custom_id')],
            'appointment_id' => ['required', 'string', 'max:255', Rule::exists('appointments', 'custom_id')],
            'os_sph' => ['nullable', 'string', 'max:255'],
            'os_cyl' => ['nullable', 'string', 'max:255'],
            'os_axis' => ['nullable', 'string', 'max:255'],
            'od_sph' => ['nullable', 'string', 'max:255'],
            'od_cyl' => ['nullable', 'string', 'max:255'],
            'od_axis' => ['nullable', 'string', 'max:255'],
            'add' => ['nullable', 'string', 'max:255'],
            'pd' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $appointmentExists = Appointment::where('custom_id', $validatedData['appointment_id'])->exists();

        if ($appointmentExists) {
            $checkup = Checkup::create([
                'patient_id' => $validatedData['patient_id'],
                'appointment_id' => $validatedData['appointment_id'],
                'os_sph' => $validatedData['os_sph'],
                'os_cyl' => $validatedData['os_cyl'],
                'os_axis' => $validatedData['os_axis'],
                'od_sph' => $validatedData['od_sph'],
                'od_cyl' => $validatedData['od_cyl'],
                'od_axis' => $validatedData['od_axis'],
                'add' => $validatedData['add'],
                'pd' => $validatedData['pd'],
                'note' => $validatedData['note'],
            ]);

            $appointment = Appointment::where('custom_id', $validatedData['appointment_id'])->first();
            $appointment->status = 'processed';
            $appointment->save();
        } else {
            return redirect()->back()->with('error', 'The specified appointment does not exist.');
        }

        return redirect()->route('records');
    }
}
