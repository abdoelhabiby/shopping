<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Dashboard\ProductContract;
use App\Contracts\Dashboard\NotificationContract;
use App\Http\Resources\Dashboard\ProdctsCollection;
use App\Http\Resources\Dashboard\AdminNotificationsCollection;

class NotificationsRepository  implements NotificationContract
{



    /**
     * fetch with datatable
     *
     * @return mixed
     */

    public function fetchDatatable()
    {


        $draw = request()->draw;
        $row = request()->start;
        $rowperpage = request()->length; // Rows display per page
        $columnIndex = isset(request()->order[0]['column']) ? request()->order[0]['column'] : 0; // Column index
        $columnName = isset(request()->columns[$columnIndex]['data']) ? request()->columns[$columnIndex]['data'] : 'created_at'; // Column name
        $columnSortOrder = isset(request()->order[0]['dir']) ? request()->order[0]['dir'] : 'desc'; // asc or desc
        $search = isset(request()->search['value']) ? request()->search['value'] : null; // Search value


        $column_can_order = ['read_at', 'created_at'];

        //-------filter------
        $notifications = admin()->notifications();


        $totalRecords = admin()->notifications()->count();
        $totalRecordwithFilter = $notifications->get()->count();

        $data = $notifications->skip($row)
            ->limit($rowperpage)
            ->get();

        $data = AdminNotificationsCollection::collection($data)->response()->getData(true);


        $response = array(
            'row' => $row,
            "draw" => intval($draw),
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "iTotalRecords" => $totalRecords,
            "aaData" => $data['data']
        );


        return json_encode($response);
    }

    // --------------------------------------

    public function fetch($limit = 6)
    {
        $notifications = admin()->notifications()->latest()->limit($limit)->get();

        return    $collection = AdminNotificationsCollection::collection($notifications);
    }

    // ---------------------------------

    public function makeAllNotificationsAsRead()
    {
        if( admin()->unreadNotifications()->count() > 0){
            admin()->unreadNotifications->markAsRead();
            return true;
        }

    }
    // ---------------------------------

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findNotificationById( $id)
    {
            return admin()->notifications()->where('id',$id)->first();

    }





    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteNotification( $id)
    {
        try {


            $notification = $this->findNotificationById($id);
            $notification->delete();

            return true;

        } catch (\Throwable $th) {

            Log::alert($th);
            return false;
        }
    }
}
