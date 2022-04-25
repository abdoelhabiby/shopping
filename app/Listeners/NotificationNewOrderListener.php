<?php

namespace App\Listeners;

use App\Events\NotificationNewOrderEvenet;
use App\Notifications\Dashboard\AdminNewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationNewOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationNewOrderEvenet  $event
     * @return void
     */
    public function handle($event)
    {
        admin()->notify(new AdminNewOrderNotification($event->order));

    }
}
