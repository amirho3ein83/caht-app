<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;

class CreateNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create notification';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Notification::factory(1)->create();
    }
}
