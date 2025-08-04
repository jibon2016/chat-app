<?php

use App\Events\MessageSend;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rever-start', function () {
    Artisan::call('reverb:start');
});

Route::middleware('auth')->group(function () {
    Route::get('/all-user', [UserController::class, 'getAllUser']);
    Route::get('/auth-user', [UserController::class, 'getAuthUser']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);

    Route::get('/chat/{sender}/{receiver}', [ChatController::class, 'getUserChat']);
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/run-npm', function () {
    // Only for development use
    $output = null;
    $returnVar = null;
    exec('npm run build', $output, $returnVar); // Replace with your command

    return response()->json([
        'output' => $output,
        'status' => $returnVar === 0 ? 'Success' : 'Error',
    ]);
});

require __DIR__.'/auth.php';
