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

        $packages = PsychologistPackage::select('psychologist_packages.id','psychologist_packages.price','packages.name as pack_name','packages.name as pack_id')
                                        ->join('packages','package_id','=','packages.id')
                                        ->where('psychologist_id','=',$idPsychologist)
                                        ->get();
        return ['packages' => $packages];

    }

    public function historyPayment(){

        $orders = Order::select('orders.created_at','midtra','psychologists.name as psy_name','packages.name as pack_name','number as order_id')
                        ->join('psychologist_packages','psychologist_packages.id','=','psychologist_package_id')
                        ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
                        ->join('packages','packages.id','=','psychologist_packages.package_id')
                        ->where('user_id','=',Auth::user()->id)
                        ->orderBy('orders.id','DESC')
                        ->get();
        return Inertia::render('PaymentHistory',[
            'orders' => $orders
        ]);

    }
}
