<?php

namespace App\Http\Controllers;


use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    protected $_validation = [
        'username' => ['required', 'string', 'unique:users', 'max:255'],
    ];


    public function chats(Request $request)
    {
        $blocked_accounts = Auth::user()->blockedAccounts->pluck('id')->toArray();
        $muted_chats = Auth::user()->mutedChats->pluck('id')->toArray();

        $res = Auth::user()->chats->load("users")->map(function ($chat) use ($blocked_accounts, $muted_chats) {


            // find blocked users (chats)
            $chat->users->map(function ($user, $index) use ($blocked_accounts, $chat) {

                if (in_array($user->id, $blocked_accounts)) {
                    $chat->is_blocked = true;
                }
                if ($user->id == Auth::id()) {
                    unset($chat->users[$index]);
                }
            });
            // get number of unread messages

            if (count($chat->messages) != 0) {

                $chat->messages->map(function ($message) use ($chat) {
                    if ($message->seen == false && $message->from != Auth::id()) {
                        $chat->unread_messages_count++;
                        $chat->has_new_message = true;
                    }
                });
                $chat->last_message = $chat->messages[0]->text;
            }

            // find muted (chats)
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
        $chat->delete();
    }

    public function createChat(User $user)
    {
        $auth_user = User::find(Auth::id());

        $auth_user->followings()->attach($user);

        // $user->followings()->attach($auth_user);

        $chat = Chat::create([
            'name' => $auth_user->username . "" . $user->username
        ]);

        $chat->users()->attach($auth_user->id);
        $chat->users()->attach($user->id);
    }

    // public function setChatlastMessage(Request $request, $id)
    // {

    //     // use redis here 

    //     // $chat = Chat::where('id', $id)->update(['last_message' => $request->last_message]);
    //     // if ($chat) {
    //     //     Log::info('done');
    //     // }
    // }
    public function muteChat(Chat $chat)
    {
        $chat->mutedBy()->attach(Auth::id());
    }

    public function unmuteChat(Chat $chat)
    {
        $chat->mutedBy()->detach(Auth::id());
    }
}
