<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{

    protected $_validation = [
        'username' => ['required', 'string', 'unique:users', 'max:255'],
    ];






    public function conversations(Request $request)
    {
        Log::info($request->contactId);
        return  contact::find($request->contactId)->conversations()->get();
    }

    public function messages(Conversation $conversation)
    {
        return $conversation->messages()
            ->latest('sent_datetime')
            ->get();
    }

    public function addContact(Request $request)
    {
        $Validator = Validator::make($request->only(['username']), $this->_validation)->validate();

        try {

            $contact = Contact::firstWhere('username', $request->username);

            $conversation = Conversation::create();

            $conversation->contacts()->attach($contact->id);
            $conversation->contacts()->attach(Auth::id());
            
        } catch (\Throwable $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }


    public function onlineContact(Request $request, $id)
    {
        Contact::where('id', $id)->update([
            'is_online' => 1
        ]);
    }
    public function offlineContact(Request $request, $id)
    {
        Contact::where('id', $id)->update([
            'is_online' => 0
        ]);
    }

    public function getContact($id)
    {
        return Contact::where('id', $id)
            ->get();
    }

    // public function setConversationlastMessage(Request $request, $id)
    // {

    //     // use redis here 

    //     // $conversation = Conversation::where('id', $id)->update(['last_message' => $request->last_message]);
    //     // if ($conversation) {
    //     //     Log::info('done');
    //     // }
    // }

    public function newMessage(Conversation $conversation, Request $request)
    {

        $newMessage = $conversation->messages()->create([
            'from' => $request->from,
            'to' => $request->to,
            'text' => $request->text,
            'conversation_id' => $request->conversation_id
        ]);

        broadcast(new NewMessage($newMessage))->toOthers();
    }
}
