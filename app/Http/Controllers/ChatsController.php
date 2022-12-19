<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\Psychologist;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $psychologists = Psychologist::all();
        return Inertia::render('Chat', [
            'user' => $user,
            'psychologists' => $psychologists
        ]);
    }

    public function indexMessage($idPsychologist)
    {
        $user = Auth::user();
        $psychologists = Psychologist::all();
        $first = DB::statement('SELECT messages.id,users.id as u_id, users.email as u_email, sender_id,recipient_id,model_sender_id,model_recipient_id,message,messages.created_at,psychologists.email FROM messages
        JOIN users ON IF(model_sender_id=2,users.id = sender_id,FALSE)
        JOIN psychologists ON psychologists.id = recipient_id
        WHERE sender_id = 1 AND recipient_id = 1');

        $first = Message::select('messages.id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email')
            ->join('users', 'users.id', '=', 'sender_id')
            ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
            ->where('model_sender_id', '=', 2)
            ->where('sender_id', '=', Auth::user()->id)
            ->where('recipient_id', '=', $idPsychologist);

        $messages = Message::select('messages.id as m_id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email')
            ->join('users', 'users.id', '=', 'sender_id')
            ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
            ->where('model_sender_id', '=', 1)
            ->where('sender_id', '=', $idPsychologist)
            ->where('recipient_id', '=', Auth::user()->id)->union($first)->orderBy('m_id')->get();
        return Inertia::render('Message', [
            'messages' => $messages,
            "idPsychologist" => $idPsychologist,
            'user' => $user,
            'psychologists' => $psychologists
        ]);
    }

    public function fetchMessages($idPsychologist)
    {
        $first = DB::statement('SELECT messages.id,users.id as u_id, users.email as u_email, sender_id,recipient_id,model_sender_id,model_recipient_id,message,messages.created_at,psychologists.email FROM messages
        JOIN users ON IF(model_sender_id=2,users.id = sender_id,FALSE)
        JOIN psychologists ON psychologists.id = recipient_id
        WHERE sender_id = 1 AND recipient_id = 1');

        $first = Message::select('messages.id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email')
            ->join('users', 'users.id', '=', 'sender_id')
            ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
            ->where('model_sender_id', '=', 2)
            ->where('sender_id', '=', Auth::user()->id)
            ->where('recipient_id', '=', $idPsychologist);

        $messages = Message::select('messages.id as m_id', 'users.id as u_id', 'users.email as u_email', 'sender_id', 'recipient_id', 'model_sender_id', 'model_recipient_id', 'message', 'messages.created_at', 'psychologists.email')
            ->join('users', 'users.id', '=', 'sender_id')
            ->join('psychologists', 'psychologists.id', '=', 'recipient_id')
            ->where('model_sender_id', '=', 1)
            ->where('sender_id', '=', $idPsychologist)
            ->where('recipient_id', '=', Auth::user()->id)->union($first)->orderBy('m_id')->get();
        return ['messages' => $messages, "idPsychologist" => $idPsychologist];
        // return back()->with(['messages' => $messages, "idPsychologist" => $idPsychologist]);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = new Message;

        $message->sender_id = $user->id;
        $message->recipient_id = $request->idPsychologist;
        $message->model_sender_id = 2;
        $message->model_recipient_id = 1;
        $message->message = $request->message;

        $message->save();
        broadcast(new MessageSent($user->id, $message,$request->idPsychologist))->toOthers();


    }
}
