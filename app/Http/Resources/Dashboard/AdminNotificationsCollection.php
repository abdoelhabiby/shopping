<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminNotificationsCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

       $data = $this->data;

       $url = '';
       if(isset($data['url'])){
        $url = $data['url'] . '?notify=' . $this->id;
       }



        return [
            'id' => $this->id,
            'title' => isset($data['title']) ? $data['title'] : '',
            'message' => isset($data['message']) ? $data['message'] : '',
            'url' => $url,
            // 'image' => isset($data['image']) ? $data['image'] : '',
            'date' => $this->created_at->diffForHumans(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'read_at' => $this->read_at ? $this->read_at->format('Y-m-d H:i:s') : null
        ];

    }
}
