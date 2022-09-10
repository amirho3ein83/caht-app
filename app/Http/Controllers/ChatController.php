<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Blocked;
use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
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






    public function chats(Request $request)
    {
        return Auth::user()->chats;
    }


    public function messages(Chat $chat)
    {
        return $chat->messages()
            ->latest('sent_datetime')
            ->get();
    }

    // public function follow(Request $request)
    // {
    //     try {

    //         $user = User::firstWhere('username', $request->username);

    //         $chat = Chat::create([
    //             'name' => $user->username . "" . Auth::user()->user->username
    //         ]);

    //         $chat->users()->attach($user->id);
    //         $chat->users()->attach(Auth::id());
    //     } catch (\Throwable $e) {
    //         Log::info($e);
    //         return back()->withError($e->getMessage());
    //     }
    // }
    public function startMessaging(Request $request)
    {
        try {

            $user = User::firstWhere('username', $request->username);

            $chat = Chat::create([
                'name' => $user->username . "" . Auth::user()->user->username
            ]);

            $chat->users()->attach($user->id);
            $chat->users()->attach(Auth::id());
        } catch (\Throwable $e) {
            Log::info($e);
            return back()->withError($e->getMessage());
        }
    }


    // public function onlineUser(Request $request, $id)
    // {
    //     // broadcast(new UserWentOnline($userId))->toOthers();

    //     // here should use redis

    //     User::where('id', $id)->update([
    //         'is_online' => 1
    //     ]);
    // }
    // public function offlineUser(Request $request, $id)
    // {
    //     // broadcast(new UserWentOffline($userId))->toOthers();
    //     // here should use redis

    //     User::where('id', $id)->update([
    //         'is_online' => 0
    //     ]);
    // }

    public function getUser(Request $request)
    {
        return User::where('username', $request->username)
            ->get();
    }

    public function deleteChat(Chat $chat, User $user)
    {
        $chat->users()->detach([Auth::id(), $user->id]);

        Message::where('chat_id', $chat->id)->delete();

        $chat->delete();
    }

    public function exploreUsers(Request $request)
    {

        $user  = User::find(Auth::id());

        foreach ($user->chats as $key => $chat) {

            $users = $chat->users;
            foreach ($users as $key => $user) {
                $ids[] = $user->id;
            }
        }
        $user_ids = User::whereIn('id', $ids)->get()->pluck('id');

        $users =  User::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('username', 'like', "%{$search}%");
            })
            ->whereNotIn('id', $user_ids)
            ->get();

        return $users;
    }


    // public function setChatlastMessage(Request $request, $id)
    // {

    //     // use redis here 

    //     // $chat = Chat::where('id', $id)->update(['last_message' => $request->last_message]);
    //     // if ($chat) {
    //     //     Log::info('done');
    //     // }
    // }

    public function sendMessage(Chat $chat, Request $request)
    {
        $sendMessage = $chat->messages()->create([
            'from' => $request->from,
            'text' => $request->text,
            'chat_id' => $request->chat_id
        ]);

        broadcast(new NewMessage($sendMessage))->toOthers();
    }



    public function blockAccount($id)
    {

        Blocked::create([
            'created_by' => Auth::id(),
            'blocked_user' => $id
        ]);
    }

    public function unblockAccount($id)
    {
        Blocked::where([['created_by', Auth::id()], ['blocked_user', $id]])->delete();
    }

    public function blockedAccounts($id)
    {
        $ids = Blocked::where([['created_by', Auth::id()], ['blocked_user', $id]])->pluck('blocked_user')->toArray();

        $blocked_accounts = User::whereIn('id', $ids)->get();

        return $blocked_accounts;
    }
}
