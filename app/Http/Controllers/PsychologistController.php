<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Midtrans\Transaction;
use Midtrans\Config;
class PsychologistController extends Controller
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
    public function dashboard(){
        return Inertia::render('PsychologistDashboard',[
            'user' => Auth::guard('psychologist')->user()
        ]);
    }

    public function historyPayment(){

        $orders = Order::select('users.name as uname','orders.created_at','midtra','psychologists.name as psy_name','packages.name as pack_name','number as order_id')
                        ->join('psychologist_packages','psychologist_packages.id','=','psychologist_package_id')
                        ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
                        ->join('packages','packages.id','=','psychologist_packages.package_id')
                        ->join('users','users.id','=','orders.user_id')
                        ->where('psychologists.id','=',Auth::guard('psychologist')->user()->id)
                        ->orderBy('orders.id','DESC')
                        ->get();
        $user = Auth::guard('psychologist')->user();
        return Inertia::render('PsychologistPaymentHistory',[
            'orders' => $orders,
            'user' => $user
        ]);

    }

    public function showPayment($orderId){
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
                        ->join('psychologist_packages','psychologist_packages.id','=','psychologist_package_id')
                        ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
                        ->where('psychologists.id','=',Auth::guard('psychologist')->user()->id)
                        ->get(); 
        return [
            'order' => $order,
            'transaction' => $transaction
            ];
    }

    public function chatClient($orderId){
        $order = Order::select('psychologists.name as psy_name','orders.number as order_id','orders.start_from as start')
                        ->join('psychologist_packages','orders.psychologist_package_id','=','psychologist_packages.id')
                        ->join('psychologists','psychologists.id','=','psychologist_packages.psychologist_id')
                        ->where('number','=',$orderId)
                        ->where('psychologists.id','=',Auth::guard('psychologist')->user()->id)
                        ->get(); 
        $canChat = null;
        if($order[0]->start == null){
            $canChat = True;
        }
        $user = Auth::guard('psychologist')->user();
        return Inertia::render('PsychologistMessage',[
            'showMessage' => True,
            'canChat' => $canChat,
            'order' => $order,
            'user' => $user
        ]);
    }

    public function fetchMessages($orderId)
    {

        $messages = Message::select('orders.number as order_id','messages.message','model_sender_id','messages.created_at','read_at')
                            ->join('orders','orders.id','=','messages.order_id')
                            ->where('orders.number','=',$orderId)
                            ->get();

        // $first = Message::select('messages.id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email','read_at')
        //     ->join('users', 'users.id', '=', 'sender_id')
        //     ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
        //     ->where('model_sender_id', '=', 2)
        //     ->where('sender_id', '=', Auth::user()->id)
        //     ->where('recipient_id', '=', $idPsychologist);

        // $messages = Message::select('messages.id as m_id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email','read_at')
        //     ->join('users', 'users.id', '=', 'recipient_id')
        //     ->join('psychologists', 'psychologists.id', '=', 'sender_id')
        //     ->where('model_sender_id', '=', 1)
        //     ->where('sender_id', '=', $idPsychologist)
        //     ->where('recipient_id', '=', Auth::user()->id)->union($first)->orderBy('m_id')->get();
        // foreach ($messages as $message) {
        //     if($message->read_at == null && $message->model_recipient_id == 2){
        //         $message = Message::find($message->m_id);
        //         $message->read_at = Time::now()->toDateTimeString();
        //         $message->save();
        //     }
        // }
        return ['messages' => $messages];
        // return back()->with(['messages' => $messages, "idPsychologist" => $idPsychologist]);
    }

    public function sendMessage(Request $request)
    {
        $order = Order::select('orders.id')
                        ->where('number','=',$request->orderId)
                        ->get();

        // return ['messages' => $order];
        // $idPsychologist = Order::select('id')
        //                         ->join('psychologist_packages','orders.psychologist_package_id','=','psychologist_packages.id')
        //                         ->join('psychologists','psychologist_packages.psychologist_id','=','psychologists.id')
        //                         ->get(); 
        $message = new Message;

        $message->order_id = $order[0]->id;
        $message->model_sender_id = 1;
        $message->model_recipient_id = 2;
        $message->message = $request->message;

        $message->save();

        // $messages_not_read = Message::select('messages.id as m_id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email','read_at')
        // ->join('users', 'users.id', '=', 'recipient_id')
        // ->join('psychologists', 'psychologists.id', '=', 'sender_id')
        // ->where('model_sender_id', '=', 1)
        // ->where('sender_id', '=', $idPsychologist)
        // ->where('recipient_id', '=', $user->id)
        // ->where('read_at','=',null)->get();
        // foreach ($messages_not_read as $message_not_read) {
        //     $message_not_read = Message::find($message_not_read->m_id);
        //     $message_not_read->read_at = Time::now()->toDateTimeString();
        //     $message_not_read->save();
        // }
        // MessageSent::dispatch($message);
        broadcast(new MessageSent($message))->toOthers();

    }

}
