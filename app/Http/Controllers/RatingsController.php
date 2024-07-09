<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rate' => ['required', 'numeric', 'min:1', 'max:5'],
            'feedback' => ['nullable', 'string', 'max:255'],
        ]);

        $customId = $request->input('id');
        $appointment = Appointment::where('custom_id', $customId)->first();
        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found');
        }

        $rating = Ratings::create([    
            'appointment_id' => $customId,
            'rate' => $validatedData['rate'],
            'feedback' => $validatedData['feedback'],   
        ]);
        $appointment->update(['has_rate' => true]);
        return redirect()->back();
    }
}