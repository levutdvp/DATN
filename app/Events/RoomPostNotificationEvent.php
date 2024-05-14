<?php

namespace App\Events;

use App\Jobs\RoomPostNotificationJob;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class RoomPostNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    use SerializesModels;
    public $user;
    public $mailTo;
    public $content;
   /**
     * Create a new event instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct($mailTo,$content)
    {
        // $data['email'][0] = 'lmt.3102003@gmail.com';
        // $admin =  User::where('role', 'admin')->first();
        $data['email'][0] = $mailTo;
        $this->content=$content;
        dispatch(new RoomPostNotificationJob($data,$this->content));
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
