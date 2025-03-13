<?php 
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageEvent implements ShouldBroadcast
{
    use InteractsWithSockets; // Removed SerializesModels

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('chat.' . $this->message->mechanic_id);
    }
}
