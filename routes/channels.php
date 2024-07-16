<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// This is the privet channel users can subscribe to.
Broadcast::channel('chat.{receiver}', function (User $user, $id) {
    return $user->only('id', 'name');
});

Broadcast::channel('app', function (User $user){
    return true;
});
