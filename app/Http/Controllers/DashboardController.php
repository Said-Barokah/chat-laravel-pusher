<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Psychologist;
use App\Models\PsychologistPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexPsychologist(){
        $psychologists = Psychologist::all();
        return ['psychologists' => $psychologists];
    }

    public function indexPackages($idPsychologist){
        $packages = PsychologistPackage::where('psychologist_id','=',$idPsychologist)->get();
        return ['packages' => $packages];
    }
}
