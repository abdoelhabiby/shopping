<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Events\Dashboard\NotificationNewOrderEvenet;

class AdminNotificationService
{

    public static function notificationNewOrder(Order $order)
    {
        broadcast(new NotificationNewOrderEvenet($order));
    }


}
