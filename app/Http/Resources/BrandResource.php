<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'brand';

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'brand_id' => $this->id,
            'brand_name' => $this->name,
            'brand_photo' => url($this->photo),
            'created_at' => $this->created_at
        ];
    }
}
