<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'item';

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'item_id' => $this->id,
            'item_name' => $this->name,
            'item_price' => $this->price,
            'item_desc' => $this->description,
            'item_photo' => url($this->photo),
            'brand' => $this->brand_id,
            'subcategory' => $this->subcategory_id,
            'created_at' => $this->created_at
        ];
    }
}
