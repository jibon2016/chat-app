<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// This is the privet channel users can subscribe to.
Broadcast::channel('chat.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});
