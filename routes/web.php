<?php

use App\Events\MessageSend;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/broadcast', function () {

//     broadcast(new MessageSend(User::find(1),Chat::find(1)));
// });

Route::middleware('auth')->group(function () {
    Route::get('/all-user', [UserController::class, 'getAllUser']);
    Route::get('/auth-user', [UserController::class, 'getAuthUser']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
