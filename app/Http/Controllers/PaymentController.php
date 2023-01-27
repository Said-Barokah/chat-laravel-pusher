<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PsychologistPackage;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\Midtrans;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Midtrans\Transaction;
use Midtrans\Config;

class PaymentController extends Controller 
{
    protected $serverKey;
    protected $isProduction;
    protected $isSanitized;
    protected $is3ds;
 
    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.is_production');
        $this->isSanitized = config('midtrans.is_sanitized');
        $this->is3ds = config('midtrans.is_3ds');
 
        $this->_configureMidtrans();
    }
 
    public function _configureMidtrans()
    {
        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }
    public function index(){
        $orders = Order::join('psychologist_packages','psychologist_packages.id','=','psychologist_package_id')
                        ->where('user_id','=',Auth::user()->id)->get();
        return ['orders' => $orders];
    }
    public function getToken($idPackage){
        $package = PsychologistPackage::find($idPackage);
        $midtrans = new CreateSnapTokenService($package);
        $snapToken = $midtrans->getSnapToken();

        return ['token' => $snapToken];
    }

    public function show($orderId){
        $transaction = Transaction::status($orderId);
        // return dd($transaction);
        if($transaction->transaction_status == 'settlement'){
            $order = Order::where('number','=',$orderId)->update(['payment_status' => 2]);
        }
        // $order = Order::join('psychologist_packages','orders.psychologist_package_id','=','psychologist_packages.id')
        //                 ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
        //                 ->where('number','=',$orderId)
        //                 ->where('user_id','=',Auth::user()->id)
        //                 ->get(); 
        $order = Order::where('number','=',$orderId)
                        ->where('user_id','=',Auth::user()->id)
                        ->get(); 
        return [
            'order' => $order,
            'transaction' => $transaction
            ];
    }

    public function chat($orderId){
        $order = Order::select('psychologists.name as psy_name','orders.number as order_id','orders.start_from as start')
                        ->join('psychologist_packages','orders.psychologist_package_id','=','psychologist_packages.id')
                        ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
                        ->where('number','=',$orderId)
                        ->where('user_id','=',Auth::user()->id)
                        ->get(); 
        $canChat = null;
        if($order[0]->start == null){
            $canChat = True;
        }
        return Inertia::render('Message',[
            'showMessage' => True,
            'canChat' => $canChat,
            'order' => $order
        ]);
    }

    public function store($idPackage, Request $request){
        $status = $request->transaction_status;
        // $fraud = $notif->fraud_status;
        if($status == 'pending'){
            $status = 1;
            $code = null;
            $midtra = $request->payment_type;
            if($request->permata_va_number){
                $midtra = 'Bank Permata';
                $code = $request->permata_va_number;
            }
            if($request->va_numbers){
                foreach($request->va_numbers as $va){
                    $midtra = $va['bank'];
                    $code = $va['va_number'];
                }
            }
            if($request->payment_type == 'cstore'){
                $midtra = 'Indomaret';
                if($request->fraud_status){
                    $midtra = 'Alfamaret';
                }
                
                $code = $request->payment_code;
            }
            if($request->payment_type == 'qris'){
                $midtra = 'qris (shopee pay/gopay)';
            }   
        }
        Order::create([
            'payment_type' => $request->payment_type,
            'midtra' => $midtra,
            'number' => $request->order_id,
            'user_id' => Auth::user()->id,
            'payment_code' => $code,
            'psychologist_package_id' => $idPackage,
            'payment_status' => $status,
            'snap_token' => $request->transaction_id
        ]);
    }
}
