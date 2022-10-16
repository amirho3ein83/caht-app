<?php

namespace App\Console\Commands;

use App\Events\NewMessage;
use App\Models\Chat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create message';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sendMessage = Chat::find(4)->messages()->create([
            'from' => 5,
            'text' => Str::random(10),
            'chat_id' => 4,
            'seen' => 0
        ]);
        // info($sendMessage);
        broadcast(new NewMessage($sendMessage))->toOthers();
    }
}
