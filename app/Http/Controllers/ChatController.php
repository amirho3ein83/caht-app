<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Jobs\MessageBroadcast;
use App\Models\Blocked;
use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ChatController extends Controller
{

    protected $_validation = [
        'username' => ['required', 'string', 'unique:users', 'max:255'],
    ];






    public function chats(Request $request)
    {
        $blocked_accounts = Auth::user()->blockedAccounts->pluck('id');
        // Log::info($blocked_accounts);
        //         $user = Auth::user();
        // $posts = Chat::where(function($q) use ($user){
        //       $q)
        // })->get();


        // $chats = Chat::whereHas('users', function ($query) {
        //     return $query->whereIn('users.id', $this->ids);
        // })->get();

        // return Auth::user()->chats->whereHas('users', function ($query)use( $blocked_accounts) {
        //         return $query->whereNotIn('users.id',  $blocked_accounts);
        //     })->get();

        return Chat::whereHas('users', function ($query) use ($blocked_accounts) {
            return $query->whereNotIn('users.id', $blocked_accounts)->whereIn('users.id', [Auth::id()]);
        })->get();



        // Log::info($ds);
    }


    public function messages(Chat $chat)
    {
        return $chat->messages()
            ->latest('sent_datetime')
            ->get();
    }
    public function deleteMessage(Message $message)
    {
        $message->delete();
    }


    public function broadcastMessage(Request $request)
    {
        MessageBroadcast::dispatch($request->chosenAccounts, $request->message, Auth::id());
    }




    public function getFollowings()
    {
        return  Cache::remember('followings', 60 * 60, function () {
            return Auth::user()->followings;
        });
    }
    public function getFollowers()
    {
        return  Cache::remember('followers', 60 * 60, function () {
            return Auth::user()->followers;
        });
    }

    public function follow(Request $request)
    {
        try {

            $user = User::firstWhere('username', $request->username);
            $me = User::firstWhere('id', Auth::id());

            $me->followings()->attach($user);
        } catch (\Throwable $e) {
            Log::info($e);
            return back()->withError($e->getMessage());
        }

        Cache::forget('followings');
    }
    public function startMessaging(Request $request)
    {
        try {

            $user = User::firstWhere('username', $request->username);

            $chat = Chat::create([
                'name' => $user->id . "-" . Auth::id()
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
            ->first();
    }
    public function getSocialMedia(Request $request)
    {
        return  Cache::remember('socialMedia', 60 * 60, function () {
            return Auth::user()->socialMedia;
        });
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

    // public function exploreAccounts(Request $request)
    // {
    //     $user  = User::find(Auth::id());

    //     foreach ($user->chats as $key => $chat) {

    //         $users = $chat->users;
    //         foreach ($users as $key => $user) {
    //             $ids[] = $user->id;
    //         }
    //     }
    //     $user_ids = User::whereIn('id', $ids)->get()->pluck('id');

    //     $users =  User::query()
    //         ->when(FacadesRequest::input('search'), function ($query, $search) {
    //             $query->where('username', 'like', "%{$search}%");
    //         })
    //         ->whereNotIn('id', $user_ids)
    //         ->get();

    //     return $users;
    //     // return Inertia::render('Chat/ExploreAccounts', ['accounts' => $users]);
    // }


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
            'from' => Auth::id(),
            'text' => $request->text,
            'chat_id' => $chat->id
        ]);

        broadcast(new NewMessage($sendMessage))->toOthers();
    }



    public function blockAccount($username)
    {

        $user = User::where('username', $username)->first();

        Blocked::create([
            'created_by' => Auth::id(),
            'blocked_user' => $user->id
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
