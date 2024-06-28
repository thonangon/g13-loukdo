<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'image_url' => $this->image ? asset('/api/products/image/' . $this->id) : null,
            'category_id' => $this->category_id,
            'category_name' => $this->category ? $this->category->category_name : null,
            'creator' => $this->user ? $this->user->name : null,
            'created_at' => $this->created_at ? $this->created_at->format('l jS, F, Y \a\t h:i:s') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('l jS, F, Y \a\t h:i:s') : null,
        ];
    }
}
