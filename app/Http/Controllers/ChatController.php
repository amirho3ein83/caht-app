<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function conversations(Request $request)
    {
        $conversation = Conversation::query()->when($request->search, function ($q, $search) {
            $q->where('name', 'like', "{$search}%");
        })
            ->with(['messages', 'groupMembers'])->get();
        return $conversation;
    }

    public function messages(Request $request, $id)
    {
        return Message::where('conversation_id', $id)
            ->latest('sent_datetime')
            ->get();
    }

    public function addContact(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

    public function getContact($id)
    {
        Log::info($id);
        return Contact::where('id', $id)
            ->get();
    }
    public function newMessage(Request $request, $id)
    {
        $newMessage = Message::create([
            'from' => Auth::id(),
            'to' => 2,
            'text' => $request->text,
            'conversation_id' => $id
        ]);


        broadcast(new NewChatMessage($newMessage))->toOthers();
        return $newMessage;
    }
}
