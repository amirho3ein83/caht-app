<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function conversations()
    {
        return Conversation::with(['messages', 'groupMembers'])->get();
    }

    public function messages(Request $request, $id)
    {
        return Message::where('conversation_id', $id)
            ->latest('sent_datetime')
            ->get();
    }
    public function newMessage(Request $request, $id)
    {
        $newMessage = Message::create([
            'from' => Auth::user()->email,
            'to' => $request->contact_mobile,
            'text' => $request->text,
            'contact_id' => $request->contact_id,
            'conversation_id' => $request->conversation_id,
        ]);
        broadcast(new NewMessage($newMessage))->toOthers();
        return $newMessage;
    }
}
