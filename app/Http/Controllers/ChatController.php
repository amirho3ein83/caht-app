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
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{

    protected $_validation = [
        'username' => ['required', 'string', 'unique:users', 'max:255'],
    ];






    public function conversations(Request $request)
    {
        $contact  = Contact::find($request->contactId);
        return $contact->conversations;
    }

    public function messages(Conversation $conversation)
    {
        return $conversation->messages()
            ->latest('sent_datetime')
            ->get();
    }

    public function addContact(Request $request)
    {
        try {

            $contact = Contact::firstWhere('username', $request->username);

            $conversation = Conversation::create([
                'name' => $contact->username . "" . Auth::user()->contact->username
            ]);

            $conversation->contacts()->attach($contact->id);
            $conversation->contacts()->attach(Auth::id());
        } catch (\Throwable $e) {
            Log::info($e);
            return back()->withError($e->getMessage());
        }
    }


    public function onlineContact(Request $request, $id)
    {
        // broadcast(new UserWentOnline($contactId))->toOthers();

        // here should use redis

        Contact::where('id', $id)->update([
            'is_online' => 1
        ]);
    }
    public function offlineContact(Request $request, $id)
    {
        // broadcast(new UserWentOffline($contactId))->toOthers();
        // here should use redis

        Contact::where('id', $id)->update([
            'is_online' => 0
        ]);
    }

    public function getContact(Request $request)
    {
        return Contact::where('username', $request->username)
            ->get();
    }
    public function exploreContacts(Request $request)
    {

        $contact  = Contact::find(Auth::id());

        foreach ($contact->conversations as $key => $conversation) {

            $contacts = $conversation->contacts;
            foreach ($contacts as $key => $contact) {
                $ids[] = $contact->id;
            }
        }
        $contact_ids = Contact::whereIn('id', $ids)->get()->pluck('id');

        $contacts =  Contact::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('username', 'like', "%{$search}%");
            })
            ->whereNotIn('id', $contact_ids)
            ->get();

        return $contacts;
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
