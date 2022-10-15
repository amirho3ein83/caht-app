<?php

use App\Events\Message;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Chat/Welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        // return Inertia::render('Dashboard');
        return redirect('chat');
    })->name('dashboard');

    Route::get('/contact-bio', function () {
        return Inertia::render('Chat/ContactBio');
    })->name('ContactBio');

    Route::get('/notifications', function () {
        return Inertia::render('Chat/Notifications');
    })->name('Notifications');

    Route::get('/settings', function () {
        return Inertia::render('Chat/Settings');
    })->name('Settings');

    Route::get('/chat', function () {
        return Inertia::render('Chat/ChatList');
    })->name('ChatList');

    Route::get('/broadcast', function () {
        return Inertia::render('Chat/BroadCast');
    })->name('BroadCast');

    Route::get('/explore-users', [UserController::class,'exploreUsers'])->name('ExploreUsers');

    Route::get('/settings', function () {
        return Inertia::render('Chat/Settings');
    })->name('Settings');


    Route::get('/chats', [ChatController::class, 'chats'])->name('chats');
    Route::delete('chats/{chat}/{id}', [ChatController::class, 'deleteChat']);
    Route::patch('chats/{id}/mute', [ChatController::class, 'muteChat']);
    Route::patch('chats/{id}/unmute', [ChatController::class, 'unmuteChat']);

    
    Route::get('/chats/{chat}/messages', [MessageController::class, 'messages'])->name('chat.messages');
    Route::post('chats/{chat}/send-message', [MessageController::class, 'sendMessage'])->name('sendMessage');
    Route::post('message/broadcasting', [MessageController::class, 'broadcastMessage'])->name('broadcastMessage');
    Route::delete('messages/{message}', [MessageController::class, 'deleteMessage'])->name('delete.message');
    // Route::post('/chat/chat/{id}/last-message', [MessageController::class, 'setChatlastMessage'])->name('chat.last_messages');

    Route::get('/social-media', [UserController::class, 'getSocialMedia'])->name('user.socialMedia');
    
    // Route::post('{user}/online', [ChatController::class, 'onlineContact'])->name('onlineContact');
    // Route::post('{user}/offline', [ChatController::class, 'offlineContact'])->name('offlineContact');
    
    Route::get('/follow/{username}', [UserController::class, 'follow'])->name('follow');
    Route::get('following/{username}/get-details', [UserController::class, 'getUser'])->name('getUser');
    // Route::get('/search-followings', [ChatController::class, 'searchFollowings'])->name('searchFollowings');
    // Route::get('/search-followers', [ChatController::class, 'searchFollowers'])->name('searchFollowers');
    Route::get('followings', [UserController::class, 'getFollowings'])->name('getFollowings');
    Route::get('followers', [UserController::class, 'getFollowers'])->name('getFollowers');


    Route::patch('block/{username}', [UserController::class, 'blockAccount']);
    Route::patch('unblock/{id}', [UserController::class, 'unblockAccount'])->name('unblocked-account');
    Route::get('blocked-accounts', [UserController::class, 'blockedAccount'])->name('blocked-account');


    Route::get('get/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::patch('read/notifications', [NotificationController::class, 'setNotificationsRead'])->name('notifications.read');
    Route::delete("notifications/{notification}/delete", [NotificationController::class, 'deleteNotification']);
    // Route::delete('chat/chats/{chat}/{contact}', [ChatController::class, 'clearChatHistory']);
});
