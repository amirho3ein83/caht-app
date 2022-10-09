<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        return Auth::user()->notifications;
    }
    public function deleteNotification(Notification $notification)
    {
        Log::info("message");
        if (Auth::id() != $notification->user_id) {
            abort(403,'not allowed to delete this notification!');
        }
        $notification->delete();
    }
}
