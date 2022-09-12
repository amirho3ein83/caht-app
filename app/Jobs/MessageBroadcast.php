<?php

namespace App\Jobs;

use App\Events\NewMessage;
use App\Models\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public $ids ;
    public $message ;
    public $from ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $ids , $message ,$from)
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

        $chats = Chat::whereHas('users',function($query) {
            return $query->whereIn('users.id',$this->ids);
        })->get();

        $message = $this->message;


        foreach ($chats as $key => $chat) {
                $sendMessage = $chat->messages()->create([
                'from' => $this->from,
                'text' => $message,
                'chat_id' => $chat->id
            ]);

            broadcast(new NewMessage($sendMessage))->toOthers();
        }

    }
}
