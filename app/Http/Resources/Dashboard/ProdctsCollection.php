<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdctsCollection extends JsonResource
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

        return [
            "id" => $this->id,
            "name" => $this->name,
            "sku" => $this->sku,
            "slug" => $this->slug,
            "is_active" => $this->is_active,
            "quantity" => $this->attributes->sum('qty'),
            "vendor" => $this->vendor ? $this->vendor->name : '',
            "link_images" => route('product.images.index',$this->slug),
            "link_attributes" =>  route('product.attibutes.index', $this->slug),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),


        ];
    }
}
