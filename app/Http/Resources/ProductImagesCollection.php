<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductImagesCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'image_url' => asset($this->name),
            'image_delete_url' => route('product.images.delete',[$this->product_id,$this->id])
        ];

        // return parent::toArray($request);
    }
}
