<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $val = $request->only(['email', 'password']);

        
        // If user is a department maanger.
        if (Auth::attempt(['email' => $val['email'] , 'password' => $val['password'],'isManager' => true])) {
            $request->session()->regenerate();
 
            return redirect()->intended('/department');
        }
         // If user is an employer in a department.
        if(Auth::attempt(['email' => $val['email'] , 'password' => $val['password'],'isManager' => false])){
            $request->session()->regenerate();
 
            return redirect()->intended('/user');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

        
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();


    }
}