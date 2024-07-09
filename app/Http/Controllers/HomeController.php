<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            $status = Auth()->user()->status;
            if($usertype === 'admin' && $status === 'active')
            {
                $usersCount = User::count();
                $patientsCount = User::where('usertype', 'patient')->count();
                $pendingCount = Appointment::where('status', 'pending')->count();
                $todayCount = Appointment::whereDate('date', today())->count(); 
                $users = User::orderBy('id', 'desc')->limit(5)->get();

                return view('layouts.admin_dashboard', compact('users', 'usersCount', 'patientsCount', 'pendingCount', 'todayCount'));
            }
            else if($usertype === 'staff' && $status === 'active')
            {
                return view('layouts.staff_dashboard');
            }
            else if($usertype === 'patient' && $status === 'active')
            {
                $customId = Auth::user()->custom_id;
                $appointments = Appointment::where('patient_id', $customId)
                                            ->where('status', 'pending')
                                            ->orderBy('id', 'desc')
                                            ->get();
                $apprappointments = Appointment::where('patient_id', $customId)
                                            ->where('status', 'toCheckup')
                                            ->orderBy('id', 'desc')
                                            ->get();
                $procappointments = Appointment::where('patient_id', $customId)
                                            ->where('status', 'processed')
                                            ->orderBy('id', 'desc')
                                            ->get();
                $decappointments = Appointment::where('patient_id', $customId)
                                            ->where('status', 'declined')
                                            ->orderBy('id', 'desc')
                                            ->get();

                return view('layouts.patient_dashboard', compact('appointments', 'apprappointments', 'procappointments', 'decappointments'));
            }
            else
            {
                Auth::logout();
                return redirect()->back();
            }
        }
    }
}
