<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSent;

class ChatController extends Controller
{
    public function index ()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $receiver = User::find($request->receiver_id);
        $sender = User::find($request->authUser);
        $chat = Chat::create([
            'receiver_id' => $receiver->id,
            'sender_id' => auth()->id(),
            'message' => $request->message, 
        ]);

        // Broadcast the event for Send Message
        broadcast(new MessageSend($sender, $chat));
    }
}
