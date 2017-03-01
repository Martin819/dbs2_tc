<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function create()
    {
    	return view('registration.create');
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'required|confirmed'
    	]);

    	/* $user = User::create(request(['name', 'email', 'password'])); */
        $user = new User;
        $user->name = request()->input('name');
        $user->email = request()->input('email');
        $user->password = Hash::make(request()->input('password'));
        $user->save();

        auth()->login($user);
    	return redirect()->home();
    }
}
