<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category ? $this->category->name : null,
            'creator' => $this->user ? $this->user->name : null,
            'quantity' =>$this->quantity,
            'created_at' => $this->created_at->format('l jS, F, Y \a\t h:i:s'),
            'updated_at' => $this->updated_at->format('l jS, F, Y \a\t h:i:s'),
        ];
    }
}
