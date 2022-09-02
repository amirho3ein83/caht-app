<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function conversations(Request $request)
    {
        return  GroupMember::find($request->memberId)->conversations()->get();
    }

    public function messages(Request $request, $id)
    {
        return Message::where('conversation_id', $id)
            ->latest('sent_datetime')
            ->get();
    }

    public function addContact(Request $request)
    {
        $Validator = Validator::make($request->only(['name', 'email']), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
        ])->validate();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('111111')
                ]);

                $contact = Contact::create([
                    'name' => $request->name,
                    'user_id' => $user->id
                ]);

                $groupMember = GroupMember::create([
                    'contact_id' => $contact->id,
                    'name' => $contact->name,
                ]);

                $conversation = Conversation::create([
                    'name' => $contact->name . " & " . Auth::user()->name
                ]);

                $conversation->groupMembers()->attach($groupMember->id);
                $conversation->groupMembers()->attach(Auth::id());


    }
    public function onlineContact(Request $request, $id)
    {
        GroupMember::where('id', $id)->update([
            'is_online' => 1
        ]);

        $user = GroupMember::where('id', $id)->get();
        Log::info($user);
    }
    public function offlineContact(Request $request, $id)
    {
        GroupMember::where('id', $id)->update([
            'is_online' => 0
        ]);

        $user = GroupMember::where('id', $id)->get();
        Log::info($user);
    }

    public function getContact($id)
    {
        Log::info('dsdsdsd');
        return Contact::where('id', $id)
            ->get();
    }
    public function setConversationlastMessage(Request $request, $id)
    {
        $conversation = Conversation::where('id', $id)->update(['last_message' => $request->last_message]);
        if ($conversation) {
            Log::info('done');
        }
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
