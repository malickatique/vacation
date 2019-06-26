<?php

namespace App\Events;
use App\User;
use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $message = [];

    public function __construct($message)
    {
        //
        $this->message['id'] = $message['id'];
        $this->message['user_id'] = $message['user_id'];
        $this->message['conversation_id'] = $message['conversation_id'];
        $this->message['receiver_id'] = $message['receiver_id'];
        $this->message['message'] = $message['message'];
        $this->message['created_at'] = $message['created_at'];
        $this->message['updated_at'] = $message['updated_at'];
        $this->message['user'] = $message['user'];
        // $this->dontBroadcastToCurrentUser();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->message['receiver_id']);
    }
}
