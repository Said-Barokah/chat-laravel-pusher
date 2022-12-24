<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class AuthenticatedSessionController extends Controller
{
    public function createPsychologist(){
        return Inertia::render('PsychologistLogin');
    }
    public function storePsychologist(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::guard('psychologist')->attempt($credentials)) {
            return redirect()->route('psychologist.dashboard');
        }
        else {
            return back()->with('error','Periksa lagi inputan anda');
        }
    }
    public function destroyPsychologist(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
