<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        Log::info('sssss');
        Log::info(Auth::user()->notifications);
        return Auth::user()->notifications;
    }
}
