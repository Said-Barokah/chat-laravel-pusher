<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Psychologist;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use App\Notifications\RealTimeNotification;
use Carbon\Carbon as Time;


class PsychologistChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:psychologist');
    }

    public function index()
    {
        $user = Auth::guard('psychologist')->user();
        $clients = User::all();
        return Inertia::render('PsychologistChat', [
            'user' => $user,
            'clients' => $clients
        ]);
    }

    public function indexMessage($idClient)
    {
        $user = Auth::guard('psychologist')->user();
        $clients = User::all();
        return Inertia::render('PsychologistMessage', [
            "idClient" => $idClient,
            'user' => $user,
            'clients' => $clients
        ]);
    }

    public function fetchMessages($idClient)
    {


        $first = Message::select('messages.id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email','read_at')
            ->join('users', 'users.id', '=', 'sender_id')
            ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
            ->where('model_sender_id', '=', 2)
            ->where('sender_id', '=', $idClient)
            ->where('recipient_id', '=', Auth::user()->id);

        $messages = Message::select('messages.id as m_id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email','read_at')
            ->join('users', 'users.id', '=', 'recipient_id')
            ->join('psychologists', 'psychologists.id', '=', 'sender_id')
            ->where('model_sender_id', '=', 1)
            ->where('sender_id', '=', Auth::user()->id)
            ->where('recipient_id', '=', $idClient)->union($first)->orderBy('m_id')->get();
        foreach ($messages as $message) {
                if($message->read_at == null && $message->model_recipient_id == 1){
                    $message = Message::find($message->m_id);
                    $message->read_at = Time::now()->toDateTimeString();
                    $message->save();
                }
            }
        return ['messages' => $messages, "idClient" => $idClient];
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::guard('psychologist')->user();
        $message = new Message;

        $message->sender_id = $user->id;
        $message->recipient_id = $request->idClient;
        $message->model_sender_id = 1;
        $message->model_recipient_id = 2;
        $message->message = $request->message;

        $message->save();
        // $message->notify(new RealTimeNotification($message));
        // MessageSent::dispatch($message);

        $messages_not_read = Message::select('messages.id as m_id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email','read_at')
            ->join('users', 'users.id', '=', 'sender_id')
            ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
            ->where('model_sender_id', '=', 2)
            ->where('sender_id', '=', $request->idClient)
            ->where('recipient_id', '=', $user->id)
            ->where('read_at','=',null)->get();
        foreach ($messages_not_read as $message_not_read) {
            $message_not_read = Message::find($message_not_read->m_id);
            $message_not_read->read_at = Time::now()->toDateTimeString();
            $message_not_read->save();
            }
        broadcast(new MessageSent($message))->toOthers();
    }
}
