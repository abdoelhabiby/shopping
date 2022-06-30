<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Events\Dashboard\NotificationNewOrderEvenet;
use Illuminate\Support\Facades\Log;

class AdminNotificationService
{

    public static function notificationNewOrder(Order $order)
    {
        try {
            broadcast(new NotificationNewOrderEvenet($order));
        } catch (\Throwable $th) {
            Log::alert($th);
        }
    }
}
