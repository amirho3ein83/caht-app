<?php

use App\Events\Message;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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
    $visits = Redis::incr('visits');
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'visits' => $visits,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/chat', function () {
        return Inertia::render('Chat/Container',['user' => Auth::id()]);
    })->name('chat');


    Route::get('/chat/conversations', [ChatController::class, 'conversations'])->name('conversations');

    Route::get('/chat/conversation/{id}/messages', [ChatController::class, 'messages'])->name('conversation.messages');
    Route::post('/chat/conversation/{id}/message', [ChatController::class, 'newMessage'])->name('sendMessage');
});


Route::resource('users', UserController::class);
// Route::get('ooo', function(){
//     return Inertia::render('ooo', [
//         'message' => 'adfdc',
//     ]);
// });
