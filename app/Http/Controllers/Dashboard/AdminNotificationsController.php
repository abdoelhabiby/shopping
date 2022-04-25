<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Contracts\Dashboard\NotificationContract;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Resources\Dashboard\AdminNotificationsCollection;

class AdminNotificationsController extends BaseController
{

    use AjaxResponseTrait;

    public $notification_repository;


    public function __construct(NotificationContract $notificationRepo)
    {

        $this->notification_repository = $notificationRepo;
    }


    public function index()
    {
        return view('dashboard.admins.notifications.index');
    }

    // -----------------------------------------
    public function fetchDataTable()
    {

        return $this->notification_repository->fetchDatatable();
    }


    // -----------------------------------------

    public function fetch()
    {

        $collection = $this->notification_repository->fetch();
        return $this->responseJson(false, 200, [],$collection);

    }

    // -----------------------------------------
    public function makeAllRead()
    {

        try {

            if($this->notification_repository->makeAllNotificationsAsRead()){
                return $this->responseJson(false, 200, ['success update']);
            }

            return $this->responseJson(true, 404, ['not found']);


        } catch (\Throwable $th) {

            Log::alert($th);
            return $this->responseJson(true, 404, ['not found']);

        }
    }
    // -----------------------------------------

        /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        if ($this->notification_repository->deleteNotification($id)) {
            return $this->responseJson(false, 200, ['success delete notification']);
        }

        return $this->responseJson(true, 404, ['not found']);


    }
    // -----------------------------------------
    // -----------------------------------------
}
