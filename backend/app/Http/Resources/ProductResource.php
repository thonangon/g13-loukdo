<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category ? $this->category->category_name : null,
            'user_id' => $this->user_id,
            'created_at' => Carbon::parse($this->created_at)->isoFormat('dddd Do, MMMM, YYYY [at] h:mm:ss'),
            'updated_at' => Carbon::parse($this->updated_at)->isoFormat('dddd Do, MMMM, YYYY [at] h:mm:ss')
        ];
    }


}
