<?php

namespace App\Listeners;

use App\Models\Admin;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NotificationNewOrderEvenet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Dashboard\AdminNewOrderNotification;
use Illuminate\Support\Facades\Log;

class NotificationNewOrderListener implements ShouldQueue
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

        try {
            //-----will exception error if not found permission name

            $admins = Admin::permission('receive_new_orders')->get();
            Notification::send($admins, new AdminNewOrderNotification($event->order));

        } catch (\Throwable $th) {

            Log::alert($th);
        }
    }
}
