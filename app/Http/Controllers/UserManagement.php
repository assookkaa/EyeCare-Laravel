<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\AllowedEmailDomains;
use Illuminate\Validation\Rules;

class UserManagement extends Controller
{
    public  function index(){
        $users = User::orderBy('lastname')->get();
        return view('layouts.users', compact('users'));
    }
    public  function add_user(Request $request)
    {
        $validatedData = $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:male,female'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, new AllowedEmailDomains],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,staff,patient'],
        ]);

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'birthdate' => $validatedData['birthdate'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'usertype' => $validatedData['role'],
        ]);

        return redirect()->route('users');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:male,female'],
            'birthdate' => ['required', 'date'],
            'role' => ['required', 'string', 'in:admin,staff,patient'],
        ]);

        $user = User::findOrFail($id);
        $user->lastname = $validatedData['lastname'];
        $user->firstname = $validatedData['firstname'];
        $user->gender = $validatedData['gender'];
        $user->birthdate = $validatedData['birthdate'];
        $user->usertype = $validatedData['role'];
        $user->save();

        return redirect()->back();
    }
    public function update_sec(Request $request, $id)
    {
        $validatedData = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::findOrFail($id);
        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back();
        }else{
            return back()->withInput()->withErrors(['current_password' => 'Current password dont match.']);;
        }
    }
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->route('users')->with('success', 'User activated successfully.');
    }
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'inactive';
        $user->save();

        return redirect()->route('users')->with('success', 'User deactivated successfully.');
    }
    public function general_settings($id)
    {
        $user = User::findOrFail($id);

        return view('layouts.general_settings', compact('user'));
    }
}
