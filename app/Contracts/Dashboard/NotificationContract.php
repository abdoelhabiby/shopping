<?php

namespace App\Contracts\Dashboard;

use Illuminate\Database\Eloquent\Model;


/**
 * Interface ProductContract
 * @package App\Contracts
 */
interface NotificationContract
{
    /**
     * fetch with datatable
     *
     * @return mixed
     */
    public function fetchDatatable();

    /**
     * fetch with datatable
     *
     * @return mixed
     */
    public function fetch($limit = 6);
    // -------------------------------
    public function makeAllNotificationsAsRead();

    // -------------------------------

    /**
     * @param int $id
     * @return mixed
     */
    public function findNotificationById( $id);
    /**
     * @param int $id
     *
     */
    public function deleteNotification( $id);
}
