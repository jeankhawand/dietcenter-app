<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request); used to return all the date
        // to customize it so we can call it from vue
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image'=> $this->image,
            'price'=> $this->price,
        ];
    }
}
