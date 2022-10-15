<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Jobs\MessageBroadcast;
use App\Models\Blocked;
use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class ChatController extends Controller
{

    protected $_validation = [
        'username' => ['required', 'string', 'unique:users', 'max:255'],
    ];


    public function chats(Request $request)
    {
        $blocked_accounts = Auth::user()->blockedAccounts->pluck('id')->toArray();
        $muted_chats = Auth::user()->mutedChats->pluck('chat_id')->toArray();

        $res = Auth::user()->chats->load("users")->map(function ($chat) use ($blocked_accounts,$muted_chats) {

            $chat->users->map(function ($user, $index) use ($blocked_accounts, $chat) {

                if (in_array($user->id, $blocked_accounts)) {
                    $chat->is_blocked = true;
                }
                if ($user->id == Auth::id()) {
                    unset($chat->users[$index]);
                }
            });
            
            if (in_array($chat->id, $muted_chats)) {
                $chat->is_muted = true;
            }
            $chat->addressee = $chat->users['1'];
            return $chat;
        });

        return $res;
    }


    public function deleteChat(Chat $chat, $id)
    {
        DB::beginTransaction();

        try {

            $chat->users()->detach([Auth::id(), $id]);

            Message::where('chat_id', $chat->id)->delete();

            $chat->delete();



            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e);
        }
    }

    // public function setChatlastMessage(Request $request, $id)
    // {

    //     // use redis here 

    //     // $chat = Chat::where('id', $id)->update(['last_message' => $request->last_message]);
    //     // if ($chat) {
    //     //     Log::info('done');
    //     // }
    // }





}
