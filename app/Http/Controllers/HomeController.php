<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile.show');
    }

    public function editProfile()
    {
        return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {
        if (is_null($request['password'])) { 
            $request['password'] = Auth::user()->password;
        } else { 
            $request['password'] = \Illuminate\Support\Facades\Hash::make($request['password']); 
        }
        $user = Auth::user()->update($request->all());

        return redirect()->route('profile.me');
    }
}
