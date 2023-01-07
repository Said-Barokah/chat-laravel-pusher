<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Psychologist;
use App\Models\PsychologistPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        return Inertia::render("Dashboard");
    }
    public function indexPsychologist(){

        $psychologists = Psychologist::all();
        return ['psychologists' => $psychologists];

    }

    public function indexPackages($idPsychologist){

        $packages = PsychologistPackage::where('psychologist_id','=',$idPsychologist)
                                        ->join('packages','package_id','=','packages.id')
                                        ->get();
        return ['packages' => $packages];

    }

    public function historyPayment(){

        $orders = Order::select('orders.created_at','midtra','psychologists.name')
                        ->join('psychologist_packages','psychologist_packages.id','=','psychologist_package_id')
                        ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
                        ->where('user_id','=',Auth::user()->id)->get();
        return Inertia::render('PaymentHistory',[
            'orders' => $orders
        ]);

    }
}
