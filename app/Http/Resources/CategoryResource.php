<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'category';

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'category_id' => $this->id,
            'category_name' => $this->name,
            'category_photo' => url($this->photo),
            'created_at' => $this->created_at
        ];
    }
}
