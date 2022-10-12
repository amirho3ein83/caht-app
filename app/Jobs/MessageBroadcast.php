<?php

namespace App\Jobs;

use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class MessageBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public $ids;
    public $message;
    public $from;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ids, $message, $from)
    {
        $this->ids = $ids;
        $this->message = $message;
        $this->from = $from;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $chats = Auth::user()->chats;
        $users = array();
        foreach ($chats as $key => $chat) {
            $users[] = $chat->users->pluck('id')->toArray();
        }

        $collapsed = Arr::collapse($users);
        $filtered_users = array_filter($collapsed, function($e)  {
            return ($e !== Auth::id());
        });
        
        foreach ($this->ids as $key => $id) {

            if (Arr::has($filtered_users, $id)) {

                $chat = Chat::find($id);
                $sendMessage = $chat->messages()->create([
                    'from' => $this->from,
                    'text' => $this->message,
                    'chat_id' => $chat->id
                ]);

                broadcast(new NewMessage($sendMessage))->toOthers();
            } else {

                $user = User::find($id);

                $chat = Chat::create([
                    'name' => Auth::user()->username . "" . $user->username
                ]);
                $chat->users()->attach(Auth::id());
                $chat->users()->attach($user->id);

                $sendMessage = $chat->messages()->create([
                    'from' => $this->from,
                    'text' => $this->message,
                    'chat_id' => $chat->id
                ]);

                broadcast(new NewMessage($sendMessage))->toOthers();
            }
        }

    }
}
