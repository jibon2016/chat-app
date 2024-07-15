<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSend implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct( public User $user,public Chat $chat)
    {
        
    }

    public function broadcastWith(): array
    {
        return [
            'chat' => [
                'id' => $this->chat->id,
                'receiver_id' => $this->chat->receiver_id,
                'sender_id' => $this->chat->sender_id,
                'message' => $this->chat->message,
            ]
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.'. 1),
            // new PrivateChannel('chat.'. $this->chat->receiver_id),
        ];
    }
}
