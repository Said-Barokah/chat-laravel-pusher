<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PsychologistController extends Controller
{
    public function dashboard(){
        return Inertia::render('PsychologistDashboard',[
            'user' => Auth::guard('psychologist')->user()
        ]);
    }
}
