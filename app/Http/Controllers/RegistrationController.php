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

    public function createpass()
    {
        return view('registration.createpass');
    }

        public function storepass()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $email = request()->input('email');
        $password = Hash::make(request()->input('password'));

        User::where('email', $email)->update(array('password' => Hash::make($password)));

/*        auth()->login($user); */
        return redirect()->home();
    }
}
