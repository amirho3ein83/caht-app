<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Jobs\MessageBroadcast;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function messages(Chat $chat)
    {
        Message::where([['chat_id', $chat->id], ['from', '!=', Auth::id()]])->update([
            'seen' => 1
        ]);

        // broadcast message seen

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
            info($e);
            return back()->withError($e->getMessage());
        }
    }

    public function sendMessage(Chat $chat, Request $request)
    {
        $sendMessage = $chat->messages()->create([
            'from' => Auth::id(),
            'text' => $request->text,
            'chat_id' => $chat->id
        ]);

        broadcast(new NewMessage($sendMessage))->toOthers();
    }
}
