<?php

namespace App\Http\Controllers;

use App\Models\user; // Correct namespace for the User model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        // Validate the request
        $fields = $request->validate([
            'username' => ['required','string', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required', 'min:3','confirmed'],
        ]);

        // map 'username' to 'name'
        $fields['name'] = $fields['username'];
         unset($fields['username']);
        // Create the user
        $user = user::create($fields);

        // Log the user in
        Auth::login($user);

        // event 
        // event(new Registered ($user));
        // Redirect to the home route
        return redirect()->route('login');
    }
    // login user
    public function login(Request $request){
        // dd('ok');
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required',]
        ]);
        // dd($request);
        // try to login the user
        if(Auth::attempt($fields,$request->remember)){
            return redirect()->route('dashboard');
        }else{
            return back()->withErrors([
                'failed'=> 'The provided credentials do not match our records.'
            ]);
        }
    }
    // logout method
    public function logout(Request $request){
        //logout the user
        Auth::logout();
        // invalidate usr's session
        $request->session()->invalidate();
        //regenerate The token
        $request->session()->regenerateToken();
        // back to home page
        return redirect('/login');
    }
}
