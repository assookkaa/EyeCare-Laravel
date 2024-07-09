<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
{
    $appointments = Appointment::all();
    return response()->json($appointments);
}

    public function appoint(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'time' => ['required', 'string', 'max:255'],
                'date' => ['required', 'date'],
                'note' => ['nullable', 'string', 'max:255'],
            ]);

            // Ensure authenticated user exists and retrieve patient_id
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $patient_id = $user->custom_id;

            // Create appointment record
            $appointment = Appointment::create([
                'patient_id' => $patient_id,
                'time' => $validatedData['time'],
                'date' => $validatedData['date'],
                'note' => $validatedData['note'],
            ]);

            // Return success response
            return response()->json(['message' => 'Appointment created successfully.'], 200);

        } catch (ValidationException $e) {
            // Handle validation errors (422 Unprocessable Entity)
            return response()->json(['error' => $e->validator->errors()->first()], 422);

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // Handle unique constraint violation (409 Conflict)
                return response()->json(['error' => 'Selected time conflicts.'], 409);
            } else {
                // Handle other database errors (500 Internal Server Error)
                \Log::error('Database error: ' . $e->getMessage());
                return response()->json(['error' => 'Database error occurred.'], 500);
            }

        } catch (\Exception $e) {
            // Handle unexpected errors (500 Internal Server Error)
            \Log::error('Unexpected error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function accept($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'toCheckup';
        $appointment->save();

        return response()->json(['message' => 'Appointment accepted successfully.']);
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'cancelled';
        $appointment->save();

        return response()->json(['message' => 'Appointment cancelled successfully.']);
    }

    public function decline($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'declined';
        $appointment->save();

        return response()->json(['message' => 'Appointment declined successfully.']);
    }

    public function delete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'deleted';
        $appointment->save();

        return response()->json(['message' => 'Appointment deleted successfully.']);
    }
}
