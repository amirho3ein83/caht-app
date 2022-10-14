<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = Auth::user()->notifications;

        $notifications = json_decode($notifications, true);
        $unread_count = 0;
        foreach ($notifications as $key => $notif) {
            if ($notif['read_at'] == null) {
                $unread_count++;
            }
        }

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unread_count
        ]);
    }
    public function deleteNotification(Notification $notification)
    {
        if (Auth::id() != $notification->user_id) {
            abort(403, 'not allowed to delete this notification!');
        }
        $notification->delete();
    }
    public function setNotificationsRead()
    {
        try {
            Notification::where('user_id', Auth::id())->update([
                'read_at' => Carbon::now()
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            info($th);
        }
    }
}
