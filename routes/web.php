<?php

use App\Events\Message;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\contact;
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
    return redirect('dashboard');
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

    Route::get('/chat', function () {
        return Inertia::render('Chat/Container', ['contact' => Auth::user()->contact]);
    })->name('chat');


    Route::post('/chat/conversations', [ChatController::class, 'conversations'])->name('conversations');

    Route::get('/chat/conversations/{conversation}/messages', [ChatController::class, 'messages'])->name('conversation.messages');
    Route::post('/chat/conversations/{conversation}/message', [ChatController::class, 'newMessage'])->name('sendMessage');

    Route::get('/contact/{username}', [ChatController::class, 'addContact'])->name('addContact');

    Route::post('/member/{id}/online', [ChatController::class, 'onlineContact'])->name('onlineContact');
    Route::post('/member/{id}/offline', [ChatController::class, 'offlineContact'])->name('offlineContact');

    Route::post('get/contact/', [ChatController::class, 'getContact'])->name('getContact');

    Route::get('/contacts/explore', [ChatController::class, 'exploreContacts'])->name('exploreContacts');

    Route::get('/contact/{contact}/contacts', [ChatController::class, 'searchAvailableContacts'])->name('searchAvailableContacts');

    Route::patch('/contacts/{id}/block', [ChatController::class, 'blockContact'])->name('blockContact');
    
    Route::post('/chat/conversation/{id}/last-message', [ChatController::class, 'setConversationlastMessage'])->name('conversation.last_messages');
    Route::delete('chat/conversations/{conversation}/{contact}', [ChatController::class, 'deleteConversation']);
    // Route::delete('chat/conversations/{conversation}/{contact}', [ChatController::class, 'clearConversationHistory']);
});
