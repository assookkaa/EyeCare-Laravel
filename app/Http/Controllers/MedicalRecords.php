<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Checkup;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class MedicalRecords extends Controller
{
    public  function index(){
        $users = User::orderBy('lastname')->get();
        return view('layouts.medical_records', compact('users'));
    }
    public function records_of($id){
        $checkups = Checkup::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        $user = User::where('custom_id', $id)->first();
        return view('layouts.records_of', compact('checkups', 'user'));
    }
    public function patient_records(){
        $user_id = Auth::user()->custom_id;
        $ind_records = Checkup::where('patient_id', $user_id)->get();
        return view('layouts.patient_records', compact('ind_records'));
    }
    public function patients_history(){
        $user_id = Auth::user()->custom_id;
        $ind_history = Appointment::where('patient_id', $user_id)->whereNotIn('status', ['pending', 'toCheckup'])->orderBy('created_at', 'desc')->get();
        return view('layouts.patients_history', compact('ind_history'));
    }
}
