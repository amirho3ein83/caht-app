<?php

namespace App\Providers;

use App\Providers\NewMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\NewMessage  $event
     * @return void
     */
    public function handle(NewMessage $event)
    {
        //
    }
}
