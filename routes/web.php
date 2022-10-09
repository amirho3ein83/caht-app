<?php

use App\Events\Message;
use App\Http\Controllers\ChatController;
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

    Route::get('/explore-accounts', function () {
        return Inertia::render('Chat/ExploreAccounts');
    })->name('ExploreAccounts');

    Route::get('/settings', function () {
        return Inertia::render('Chat/Settings');
    })->name('Settings');


    Route::get('/chats', [ChatController::class, 'chats'])->name('chats');

    Route::get('/chats/{chat}/messages', [ChatController::class, 'messages'])->name('chat.messages');

    Route::post('chats/{chat}/send-message', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::post('message/broadcasting', [ChatController::class, 'broadcastMessage'])->name('broadcastMessage');

    Route::get('/follow/{username}', [ChatController::class, 'follow'])->name('follow');
    Route::get('/social-media', [ChatController::class, 'getSocialMedia'])->name('user.socialMedia');

    // Route::post('/member/{id}/online', [ChatController::class, 'onlineContact'])->name('onlineContact');
    // Route::post('/member/{id}/offline', [ChatController::class, 'offlineContact'])->name('offlineContact');

    Route::get('following/{username}/get-details', [ChatController::class, 'getUser'])->name('getUser');

    Route::get('accounts/explore', [ChatController::class, 'exploreAccounts'])->name('exploreAccounts');

    Route::get('/search-followings', [ChatController::class, 'searchFollowings'])->name('searchFollowings');
    Route::get('/search-followers', [ChatController::class, 'searchFollowers'])->name('searchFollowers');

    Route::get('followings', [ChatController::class, 'getFollowings'])->name('getFollowings');
    Route::get('followers', [ChatController::class, 'getFollowers'])->name('getFollowers');

    Route::patch('block/{username}', [ChatController::class, 'blockAccount'])->name('blocked-account');
    Route::patch('unblock/{username}', [ChatController::class, 'unblockAccount'])->name('unblocked-account');
    Route::get('blocked-accounts', [ChatController::class, 'blockedAccount'])->name('blocked-account');

    // Route::post('/chat/chat/{id}/last-message', [ChatController::class, 'setChatlastMessage'])->name('chat.last_messages');
    Route::delete('chats/{chat}/{id}', [ChatController::class, 'deleteChat']);
    Route::delete('messages/{message}', [ChatController::class, 'deleteMessage'])->name('delete.message');

    Route::get('get/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::delete("notifications/{notification}/delete", [NotificationController::class, 'deleteNotification']);
    // Route::delete('chat/chats/{chat}/{contact}', [ChatController::class, 'clearChatHistory']);
});
