<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class PsychologistLoginController extends Controller
{
    public function login(){
        return Inertia::render('PsychologistLogin');
    }
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::guard('psychologist')->attempt($credentials)) {
            return redirect()->route('psychologist.dashboard');
        }
        else {
            return back()->with('error','Periksa lagi inputan anda');
        }

    }
}
