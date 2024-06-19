<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category->category_name,
            'created_by' => $this->user->name,
            'created_at' => $this->created_at->format('l jS, F, Y \a\t h:i:s A'),
            'updated_at' => $this->updated_at->format('l jS, F, Y \a\t h:i:s A'),
        ];
    }
}
