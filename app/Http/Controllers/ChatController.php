<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function conversations(Request $request)
    {
        $contactSelf = $request->userId;
        $conversation = Conversation::query()->when($request->search, function ($q, $search) use($contactSelf) {
            $q->where('name', 'like', "{$search}%");
        })
            ->whereHas('groupMembers', function ($q) use($contactSelf){
                $q->where('id', $contactSelf);
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
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $conversation = Conversation::create([
            'name' => $contact->name,
        ]);

        $conversation->groupMembers()->create([
            'name' => $contact->name,
            'contact_id' => $contact->id,
            'conversation_id' => $conversation->id,
        ]);

        $conversation->groupMembers()->create([
            'name' => Auth::user()->name,
            'contact_id' => Auth::id(),
            'conversation_id' => $conversation->id,
        ]);
    }
    public function onlineContact(Request $request, $id)
    {
        GroupMember::where('id', $id)->update([
            'is_online' => 1
        ]);
    }
    public function offlineContact(Request $request, $id)
    {
        Log::info('user is offline');
        GroupMember::where('id', $id)->update([
            'is_online' => 0
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
