<?php

namespace App\Events\Dashboard;

use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationNewOrderEvenet implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $order;

    public function __construct($order)
    {
        $this->order = $order;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification-new-order');
    }


    public function broadcastAs()
    {
        return 'new-order-notification';
    }


    public function broadcastWith()
    {
        return [
            'notification' => 'new order notify',
            'notifications_unread_count' => admin()->unreadNotifications()->count()
        ];
    }


}
